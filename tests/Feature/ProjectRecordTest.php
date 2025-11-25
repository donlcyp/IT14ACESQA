<?php

use App\Models\Project;
use App\Models\ProjectRecord;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create or update a project record', function () {
    $project = Project::create([
        'project_name' => 'Test Project',
        'client_name' => 'Test Client',
        'status' => 'On Track',
        'lead' => 'Test Inspector',
    ]);

    $data = [
        'time' => '10:00',
        'color' => '#ff0000',
        'project_id' => $project->id,
    ];

    $response = $this->post(route('project-material-management.store'), $data);

    $response->assertRedirect(route('project-material-management'));
    $this->assertDatabaseHas('project_records', [
        'project_id' => $project->id,
        'title' => 'Test Project',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector',
        'time' => '10:00',
        'color' => '#ff0000',
    ]);
});

it('can view project records list', function () {
    ProjectRecord::factory()->count(3)->create();

    $response = $this->get(route('project-material-management'));

    $response->assertStatus(200);
    $response->assertViewHas('records');
    $response->assertViewHas('materials');
});

it('can view project record details with materials', function () {
    $projectRecord = ProjectRecord::factory()->create();
    Material::factory()->count(2)->create(['project_record_id' => $projectRecord->id]);

    $response = $this->get(route('project-material-management-show', $projectRecord));

    $response->assertStatus(200);
    $response->assertViewHas('record', $projectRecord);
    $response->assertViewHas('materials');
});

it('can delete a project record', function () {
    $projectRecord = ProjectRecord::factory()->create();

    $response = $this->delete(route('project-material-management.destroy', $projectRecord));

    $response->assertRedirect(route('project-material-management'));
    $this->assertDatabaseMissing('project_records', ['id' => $projectRecord->id]);
});

it('can create a material for a project record', function () {
    $projectRecord = ProjectRecord::factory()->create();

    $data = [
        'project_record_id' => $projectRecord->id,
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

    $response->assertRedirect(route('project-material-management-show', $projectRecord));
    $this->assertDatabaseHas('materials', $data);
});

it('can update a material', function () {
    $material = Material::factory()->create();
    $updatedData = [
        'project_record_id' => $material->project_record_id,
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

    $response->assertRedirect(route('project-material-management-show', $material->project_record_id));
    $this->assertDatabaseHas('materials', $updatedData);
});

it('can delete a material', function () {
    $material = Material::factory()->create();

    $response = $this->delete(route('project-material-management.materials.destroy', $material));

    $response->assertRedirect(route('project-material-management'));
    $this->assertDatabaseMissing('materials', ['id' => $material->id]);
});

it('validates project record creation', function () {
    $response = $this->post(route('project-material-management.store'), []);

    $response->assertRedirect();
    $response->assertSessionHasErrors(['project_id', 'time', 'color']);
});

it('validates material creation', function () {
    $response = $this->post(route('project-material-management.materials.store'), []);

    $response->assertRedirect();
    $response->assertSessionHasErrors(['project_record_id', 'name', 'quantity', 'price', 'total']);
});

it('can search project records', function () {
    ProjectRecord::factory()->create(['title' => 'Unique Project']);
    ProjectRecord::factory()->create(['client' => 'Unique Client']);

    $response = $this->get(route('project-material-management', ['search' => 'Unique']));

    $response->assertStatus(200);
    $response->assertViewHas('records', function ($records) {
        return $records->count() === 2;
    });
});
