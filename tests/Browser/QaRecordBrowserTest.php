<?php

use App\Models\QaRecord;
use App\Models\Material;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('can create a qa record through browser', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/project-material-management')
                ->click('.qa-new-button')
                ->waitFor('.qa-modal')
                ->type('#project-name', 'Matina IT Park')
                ->type('#client-name', 'Test Client')
                ->type('#inspector-name', 'Test Inspector')
                ->type('#time', '10:00')
                ->type('#color', '#ff0000')
                ->click('.qa-modal-button.primary')
                ->assertPathIs('/project-material-management')
                ->assertSee('Record created successfully');
    });
});

it('can view qa record details and materials', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector'
    ]);

    Material::factory()->count(2)->create(['qa_record_id' => $qaRecord->id]);

    $this->browse(function (Browser $browser) use ($qaRecord) {
        $browser->visit('/project-material-management')
                ->click('.qa-card[data-id="' . $qaRecord->id . '"]')
                ->assertPathIs('/project-material-management/' . $qaRecord->id)
                ->assertSee($qaRecord->title)
                ->assertSee($qaRecord->client)
                ->assertSee($qaRecord->inspector);
    });
});

it('can add material to qa record', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector'
    ]);

    $this->browse(function (Browser $browser) use ($qaRecord) {
        $browser->visit('/project-material-management/' . $qaRecord->id)
                ->click('.qa-button-base.primary')
                ->waitFor('#materialModal')
                ->type('#mat_supplier', 'BuildMart')
                ->type('#mat_received', '2025-10-03')
                ->select('#mat_status', 'Pending')
                ->type('#mat_location', 'Site A')
                ->click('button[onclick="showMaterialStep2()"]')
                ->waitFor('#materialModalStep2')
                ->click('.add-item-btn')
                ->type('.material-name', 'Concrete')
                ->type('.material-batch', 'C789')
                ->type('.material-quantity', '200')
                ->select('.material-unit', 'cubic meters')
                ->type('.material-price', '150')
                ->click('button[onclick="saveMaterial()"]')
                ->assertPathIs('/project-material-management/' . $qaRecord->id)
                ->assertSee('Materials added successfully');
    });
});

it('can update material in qa record', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector'
    ]);

    $material = Material::factory()->create([
        'qa_record_id' => $qaRecord->id,
        'name' => 'Concrete',
        'quantity' => 200,
        'status' => 'Pending'
    ]);

    $this->browse(function (Browser $browser) use ($qaRecord, $material) {
        $browser->visit('/project-material-management/' . $qaRecord->id)
                ->click('.qa-button-base.success')
                ->waitFor('#materialModal')
                ->type('#mat_supplier', 'BuildMart')
                ->type('#mat_received', '2025-10-03')
                ->select('#mat_status', 'Approved')
                ->type('#mat_location', 'Site A')
                ->click('button[onclick="showMaterialStep2()"]')
                ->waitFor('#materialModalStep2')
                ->type('.material-quantity', '250')
                ->select('.material-unit', 'cubic meters')
                ->type('.material-price', '150')
                ->click('button[onclick="saveMaterial()"]')
                ->assertPathIs('/project-material-management/' . $qaRecord->id)
                ->assertSee('Material updated successfully');
    });
});

it('can delete qa record', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector'
    ]);

    $this->browse(function (Browser $browser) use ($qaRecord) {
        $browser->visit('/project-material-management')
                ->click('#qaDeleteToggle')
                ->click('.qa-card[data-id="' . $qaRecord->id . '"]')
                ->acceptDialog()
                ->assertPathIs('/project-material-management')
                ->assertDontSee($qaRecord->title);
    });
});

it('validates material creation with invalid data', function () {
    $qaRecord = QaRecord::factory()->create([
        'title' => 'Matina IT Park',
        'client' => 'Test Client',
        'inspector' => 'Test Inspector'
    ]);

    $this->browse(function (Browser $browser) use ($qaRecord) {
        $browser->visit('/project-material-management/' . $qaRecord->id)
                ->click('.qa-button-base.primary')
                ->waitFor('#materialModal')
                ->type('#mat_supplier', 'SteelCo')
                ->type('#mat_received', '2025-10-03')
                ->select('#mat_status', 'Pending')
                ->type('#mat_location', 'Site A')
                ->click('button[onclick="showMaterialStep2()"]')
                ->waitFor('#materialModalStep2')
                ->click('.add-item-btn')
                ->type('.material-name', 'Steel')
                ->type('.material-batch', 'S101')
                ->type('.material-quantity', '-50')
                ->select('.material-unit', 'tons')
                ->type('.material-price', '200')
                ->click('button[onclick="saveMaterial()"]')
                ->assertSee('Please fill in all required fields for each material item');
    });
});
