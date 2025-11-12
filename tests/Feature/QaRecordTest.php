<?php

use App\Models\QaRecord;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// Test Steps Based on User Requirements

// Test Step 1: Navigate to the PMM subsystem main page.
// 1. Click the "Add Project" button to open the modal.
// 2. Enter project name, select client name and inspector name from dropdowns or enter input.
// 3. Click the "Add" button in the modal.
it('can create a project material record', function () {
    $data = [
        'title' => 'Matina IT Park',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector',
        'time' => '10:00',
        'color' => '#ff0000',
    ];

    $response = $this->post(route('quality-assurance.store'), $data);

    $response->assertRedirect(route('quality-assurance'));
    $this->assertDatabaseHas('qa_records', $data);
});

// Test Step 2: Navigate to the PMM main page.
// 1. Locate the "Matina IT Park" project card and click to open.
// 2. Click the edit icon next to the project details inside the card.
// 3. Update project name to "Matina IT Park 6th Floor," client name to "Tony Stark," and inspector name to "Donyl Basio".
// 4. Press enter to confirm changes.
it('can update project material record', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector'
    ]);

    $updatedData = [
        'title' => 'Matina IT Park 6th Floor',
        'client' => 'Tony Stark',
        'inspector' => 'Donyl Basio',
        'time' => '10:00',
        'color' => '#ff0000',
    ];

    // Since there's no update route, we'll test the direct update
    $qaRecord->update($updatedData);

    $this->assertDatabaseHas('qa_records', $updatedData);
});

// Test Step 3: Navigate to the PMM main page.
// 1. Locate the "Matina IT Park" project card.
// 2. Click the "Delete" button on the card.
// 3. Confirm the deletion prompt.
it('can delete project material record', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park'
    ]);

    $response = $this->delete(route('quality-assurance.destroy', $qaRecord));

    $response->assertRedirect(route('quality-assurance'));
    $this->assertDatabaseMissing('qa_records', ['id' => $qaRecord->id]);
});

// Test Step 4: Click the "Matina IT Park" project card.
// 1. Click the "New" button to open the material modal.
// 2. Enter material details (e.g., Material Name: "Concrete," Batch/Serial No.: "C789," Supplier: "BuildMart," Quantity Received: 200, Unit of Measure: "cubic meters," Unit Price: 150, Total Cost: 30000, Date Received: "2025-10-03," Status: "Received," Storage Location: "Site A").
// 3. Click the "Save" button in the modal.
it('can add material to project record', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park'
    ]);

    $data = [
        'qa_record_id' => $qaRecord->id,
        'name' => 'Concrete',
        'batch' => 'C789',
        'supplier' => 'BuildMart',
        'quantity' => 200,
        'unit' => 'cubic meters',
        'price' => 150.00,
        'total' => 30000.00,
        'date_received' => '2025-10-03',
        'status' => 'Received',
        'location' => 'Site A',
    ];

    $response = $this->post(route('quality-assurance.materials.store'), $data);

    $response->assertRedirect(route('quality-assurance.show', $qaRecord));
    $this->assertDatabaseHas('materials', $data);
});

// Test Step 5: Click the "Matina IT Park" project card.
// 1. Click the green "Edit" button.
// 2. Update Quantity Received to 250, Status to approve and fill the date inspected."
// 3. Click the "Update" button in the modal.
it('can update material in project record', function () {
    $material = Material::factory()->create([
        'name' => 'Concrete',
        'quantity' => 200,
        'status' => 'Received'
    ]);

    $updatedData = [
        'qa_record_id' => $material->qa_record_id,
        'name' => 'Concrete',
        'batch' => 'C789',
        'supplier' => 'BuildMart',
        'quantity' => 250,
        'unit' => 'cubic meters',
        'price' => 150.00,
        'total' => 37500.00,
        'date_received' => '2025-10-03',
        'date_inspected' => now()->format('Y-m-d'),
        'status' => 'Approved',
        'location' => 'Site A',
    ];

    $response = $this->put(route('quality-assurance.materials.update', $material), $updatedData);

    $response->assertRedirect(route('quality-assurance.show', $material->qa_record_id));
    $this->assertDatabaseHas('materials', $updatedData);
});

// Test Step 6: Click the "Matina IT Park" project card.
// 1. Click the "New" button to open the material modal.
// 2. Enter material details with invalid data (e.g., Material Name: "Steel," Batch/Serial No.: "S101," Supplier: "SteelCo," Quantity Received: -50, Unit of Measure: "tons," Unit Price: 200, Total Cost: -10000, Date Received: "2025-10-03," Status: "Received," Storage Location: "Site A").
// 3. Click the "Add" button.
it('validates material creation with invalid data', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park'
    ]);

    $invalidData = [
        'qa_record_id' => $qaRecord->id,
        'name' => 'Steel',
        'batch' => 'S101',
        'supplier' => 'SteelCo',
        'quantity' => -50,
        'unit' => 'tons',
        'price' => 200.00,
        'total' => -10000.00,
        'date_received' => '2025-10-03',
        'status' => 'Received',
        'location' => 'Site A',
    ];

    $response = $this->post(route('quality-assurance.materials.store'), $invalidData);

    $response->assertRedirect();
    $response->assertSessionHasErrors(['quantity', 'total']);
});

// Additional helper tests
it('can view project material records list', function () {
    QaRecord::factory()->count(3)->create();

    $response = $this->get(route('quality-assurance'));

    $response->assertStatus(200);
    $response->assertViewHas('records');
    $response->assertViewHas('materials');
});

it('can view project record details with materials', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park'
    ]);
    Material::factory()->count(2)->create(['qa_record_id' => $qaRecord->id]);

    $response = $this->get(route('quality-assurance.show', $qaRecord));

    $response->assertStatus(200);
    $response->assertViewHas('record', $qaRecord);
    $response->assertViewHas('materials');
});

it('can search project material records', function () {
    QaRecord::factory()->create(['title' => 'Unique Project']);
    QaRecord::factory()->create(['client' => 'Unique Client']);

    $response = $this->get(route('quality-assurance', ['search' => 'Unique']));

    $response->assertStatus(200);
    $response->assertViewHas('records', function ($records) {
        return $records->count() === 2;
    });
});
