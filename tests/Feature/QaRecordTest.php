<?php

use App\Models\QaRecord;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a qa record', function () {
    $data = [
        'title' => 'Test Project',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector',
        'time' => '10:00',
        'color' => '#ff0000',
    ];

    $response = $this->post(route('project-material-management.store'), $data);

    $response->assertRedirect(route('project-material-management'));
    $this->assertDatabaseHas('qa_records', $data);
});

it('can view qa records list', function () {
    QaRecord::factory()->count(3)->create();

    $response = $this->get(route('project-material-management'));

    $response->assertStatus(200);
    $response->assertViewHas('records');
    $response->assertViewHas('materials');
});

it('can view qa record details with materials', function () {
    $qaRecord = QaRecord::factory()->create();
    Material::factory()->count(2)->create(['qa_record_id' => $qaRecord->id]);

    $response = $this->get(route('project-material-management-show', $qaRecord));

    $response->assertStatus(200);
    $response->assertViewHas('record', $qaRecord);
    $response->assertViewHas('materials');
});

it('can delete a qa record', function () {
    $qaRecord = QaRecord::factory()->create();

    $response = $this->delete(route('project-material-management.destroy', $qaRecord));

    $response->assertRedirect(route('project-material-management'));
    $this->assertDatabaseMissing('qa_records', ['id' => $qaRecord->id]);
});

it('can create a material for qa record', function () {
    $qaRecord = QaRecord::factory()->create();

    $data = [
        'qa_record_id' => $qaRecord->id,
        'name' => 'Test Material',
        'batch' => 'BATCH001',
        'supplier' => 'Test Supplier',
        'quantity' => 100,
        'unit' => 'kg',
        'price' => 50.00,
        'total' => 5000.00,
        'date_received' => '2024-01-01',
        'date_inspected' => '2024-01-02',
        'status' => 'Pending',
        'location' => 'Warehouse A',
    ];

    $response = $this->post(route('project-material-management.materials.store'), $data);

    $response->assertRedirect(route('project-material-management-show', $qaRecord));
    $this->assertDatabaseHas('materials', $data);
});

it('can update a material', function () {
    $material = Material::factory()->create();
    $updatedData = [
        'qa_record_id' => $material->qa_record_id,
        'name' => 'Updated Material',
        'batch' => 'UPDATED001',
        'supplier' => 'Updated Supplier',
        'quantity' => 200,
        'unit' => 'pcs',
        'price' => 75.00,
        'total' => 15000.00,
        'date_received' => '2024-01-01',
        'date_inspected' => '2024-01-02',
        'status' => 'Approved',
        'location' => 'Warehouse B',
    ];

    $response = $this->put(route('project-material-management.materials.update', $material), $updatedData);

    $response->assertRedirect(route('project-material-management-show', $material->qa_record_id));
    $this->assertDatabaseHas('materials', $updatedData);
});

it('can delete a material', function () {
    $material = Material::factory()->create();

    $response = $this->delete(route('project-material-management.materials.destroy', $material));

    $response->assertRedirect(route('project-material-management'));
    $this->assertDatabaseMissing('materials', ['id' => $material->id]);
});

it('validates qa record creation', function () {
    $response = $this->post(route('project-material-management.store'), []);

    $response->assertRedirect();
    $response->assertSessionHasErrors(['title', 'client', 'inspector', 'time', 'color']);
});

it('validates material creation', function () {
    $response = $this->post(route('project-material-management.materials.store'), []);

    $response->assertRedirect();
    $response->assertSessionHasErrors(['qa_record_id', 'name', 'quantity', 'price', 'total']);
});

it('can search qa records', function () {
    QaRecord::factory()->create(['title' => 'Unique Project']);
    QaRecord::factory()->create(['client' => 'Unique Client']);

    $response = $this->get(route('project-material-management', ['search' => 'Unique']));

    $response->assertStatus(200);
    $response->assertViewHas('records', function ($records) {
        return $records->count() === 2;
    });
});
