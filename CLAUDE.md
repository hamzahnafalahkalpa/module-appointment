# CLAUDE.md - Module Appointment

This file provides guidance to Claude Code when working with the `hanafalah/module-appointment` package.

## Overview

Module Appointment is a Laravel package that provides appointment scheduling, reservation management, queue transactions, and kiosk functionality for healthcare settings. It is part of the Wellmed multi-tenant healthcare management system.

**Package:** `hanafalah/module-appointment`
**Namespace:** `Hanafalah\ModuleAppointment`
**Dependency:** `hanafalah/laravel-support`

## Directory Structure

```
src/
├── Contracts/
│   ├── ModuleAppointment.php          # Main contract interface
│   ├── Data/                          # Data transfer object contracts
│   │   ├── AppointmentData.php
│   │   ├── ReservationData.php
│   │   ├── QueueTransactionData.php
│   │   └── KioskData.php
│   └── Schemas/                       # Schema contracts
│       ├── Appointment.php
│       ├── Reservation.php
│       ├── QueueTransaction.php
│       └── Kiosk.php
├── Data/                              # Data transfer objects (DTOs)
│   ├── AppointmentData.php
│   ├── ReservationData.php
│   ├── QueueTransactionData.php
│   └── KioskData.php
├── Models/                            # Eloquent models
│   ├── Appointment.php
│   ├── Reservation.php
│   ├── QueueTransaction.php
│   └── Kiosk.php
├── Resources/                         # API resources
│   ├── Appointment/
│   ├── Reservation/
│   ├── QueueTransaction/
│   └── Kiosk/
├── Schemas/                           # Business logic schemas
│   ├── Appointment.php
│   ├── Reservation.php
│   ├── QueueTransaction.php
│   └── Kiosk.php
├── Supports/
│   └── BaseModuleAppointment.php      # Base class for schemas
├── ModuleAppointment.php              # Main package class
└── ModuleAppointmentServiceProvider.php
```

## Key Models and Their Relationships

### Appointment (Base Model)
- **Table:** `appointments`
- **Primary Key:** ULID (string)
- **Traits:** HasUlids, HasProps, SoftDeletes
- **Key Fields:**
  - `id` - ULID primary key
  - `name` - Appointment name
  - `reference_type` - Polymorphic type (e.g., Patient, Visit)
  - `reference_id` - Polymorphic ID
  - `status` - Appointment status
  - `scheduled_at` - Scheduled datetime
  - `checked_in_at` - Check-in datetime
  - `props` - JSON properties (HasProps trait)

**Relationships:**
- `reference()` - Morphable reference (patient, visit, etc.)
- `queueTransaction()` - Has one queue transaction

### Reservation
- **Extends:** Appointment
- **Table:** `appointments` (same table, different model)
- Used for patient reservations/bookings

### QueueTransaction
- **Table:** `queue_transactions`
- **Primary Key:** ULID (string)
- **Key Fields:**
  - `id` - ULID primary key
  - `queue_number` - Queue display number
  - `kiosk_id` - Associated kiosk
  - `reference_type` / `reference_id` - Polymorphic reference

**Relationships:**
- `reference()` - Morphable reference
- `kiosk()` - Belongs to Kiosk

### Kiosk
- **Extends:** `InventoryItem` (from module-item)
- **Table:** `inventory_items`
- Represents physical kiosk devices for queue management

**Relationships:**
- `queueTransaction()` / `queueTransactions()` - Has queue transactions

## Schema Classes

Schemas contain business logic for CRUD operations. Each schema:
- Extends `BaseModuleAppointment` or another schema
- Implements a contract interface
- Uses caching with configurable tags and duration
- Has `prepareStore{Entity}` methods for creating/updating records

### Example: Appointment Schema
```php
// Stores appointment with polymorphic reference
$appointmentSchema->prepareStoreAppointment(AppointmentData::from([
    'name' => 'Patient Visit',
    'reference_type' => 'Patient',
    'reference_id' => $patientId,
    'scheduled_at' => '2026-02-15 10:00:00',
    'status' => 'scheduled'
]));
```

## Data Transfer Objects (DTOs)

DTOs use `spatie/laravel-data` for data validation and transformation:

### AppointmentData
```php
AppointmentData::from([
    'id' => null,                    // Optional: for updates
    'name' => 'Appointment Name',
    'reference_type' => 'Patient',
    'reference_id' => 'ulid-here',
    'reference' => [...],            // Optional: nested reference data
    'scheduled_at' => '2026-02-15',
    'checked_in_at' => null,
    'status' => 'scheduled',
    'queue_transaction' => [...],    // Optional: nested QueueTransactionData
    'props' => ['custom' => 'data']
]);
```

### QueueTransactionData
```php
QueueTransactionData::from([
    'queue_number' => 'A001',
    'kiosk_id' => 'kiosk-ulid',
    'reference_type' => 'Appointment',
    'reference_id' => 'appointment-ulid'
]);
```

## API Resources

Each model has View and Show resources:
- **ViewResource** - List/index representation (minimal data)
- **ShowResource** - Detail representation (extended data with relations)

Resources use `relationValidation()` for safe relation loading and `toViewApi()`/`toShowApi()` for nested resources.

## Service Provider Configuration

### CRITICAL WARNING: Do NOT Use `registers(['*'])`

The current ServiceProvider uses a problematic pattern:

```php
// PROBLEMATIC - DO NOT USE IN PRODUCTION
public function register()
{
    $this->registerMainClass(ModuleAppointment::class)
        ->registers(['*']);  // <-- This is problematic!
}
```

**Why this is problematic:**
1. `registers(['*'])` auto-registers ALL classes in the package
2. This can cause performance issues and unexpected behavior
3. Classes may be registered that shouldn't be bound to the container
4. Can lead to memory issues in Laravel Octane environments

### Recommended Pattern

When extending `BaseServiceProvider`, explicitly register only what's needed:

```php
public function register()
{
    $this->registerMainClass(ModuleAppointment::class)
        ->registers([
            'Schemas',      // Register schema classes
            'Data'          // Register data classes if needed
        ]);

    // Or register specific bindings:
    $this->app->bind(
        Contracts\Schemas\Appointment::class,
        Schemas\Appointment::class
    );
}
```

## Usage Patterns

### Creating an Appointment
```php
use Hanafalah\ModuleAppointment\Contracts\Schemas\Appointment;
use Hanafalah\ModuleAppointment\Data\AppointmentData;

$appointmentSchema = app(Appointment::class);

$appointment = $appointmentSchema->prepareStoreAppointment(
    AppointmentData::from($request->validated())
);
```

### Creating a Reservation
```php
use Hanafalah\ModuleAppointment\Contracts\Schemas\Reservation;
use Hanafalah\ModuleAppointment\Data\ReservationData;

$reservationSchema = app(Reservation::class);

$reservation = $reservationSchema->prepareStoreReservation(
    ReservationData::from($request->validated())
);
```

### Working with Queue Transactions
```php
use Hanafalah\ModuleAppointment\Contracts\Schemas\QueueTransaction;

$queueSchema = app(QueueTransaction::class);

// Create queue transaction
$queue = $queueSchema->prepareStoreQueueTransaction(
    QueueTransactionData::from([
        'queue_number' => 'A001',
        'kiosk_id' => $kioskId,
        'reference_type' => 'Appointment',
        'reference_id' => $appointmentId
    ])
);
```

### Polymorphic References

Appointments support polymorphic references configured in `config/module-appointment.php`:

```php
// config/module-appointment.php
return [
    'reference_types' => [
        'patient' => [
            'schema' => 'Patient'  // Schema class to use
        ],
        'visit' => [
            'schema' => 'Visit'
        ]
    ]
];
```

When creating an appointment with a reference type, the schema automatically:
1. Looks up the reference schema from config
2. Creates/updates the reference using `prepareStore()`
3. Links the reference to the appointment
4. Stores reference data in props for caching

## Caching

Schemas use tag-based caching:

```php
protected array $__cache = [
    'index' => [
        'name'     => 'appointment',
        'tags'     => ['appointment', 'appointment-index'],
        'duration' => 24 * 60  // 24 hours in minutes
    ]
];
```

Remember to invalidate cache tags when modifying data.

## Testing

When writing tests for this module:
1. Use database transactions for isolation
2. Mock the schema contracts for unit tests
3. Use DTOs for consistent test data
4. Test polymorphic references with various types

## Dependencies

- `hanafalah/laravel-support` - Base classes and utilities
- `hanafalah/laravel-has-props` - JSON props handling
- `hanafalah/module-item` - For Kiosk (extends InventoryItem)
- `spatie/laravel-data` - DTO handling
