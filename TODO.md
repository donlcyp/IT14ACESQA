# TODO: Implement Add New Project with Automatic Time

## Step 1: Create Project Model and Migration
- [ ] Run `php artisan make:model Project -m` to create Project model and migration
- [ ] Edit migration to add fields: title, client_name, location, timestamps (created_at, updated_at)

## Step 2: Update ProjectsController
- [ ] Add index method to fetch and display projects from database
- [ ] Add create method to show form for new project
- [ ] Add store method to save new project (time set automatically via timestamps)

## Step 3: Add Routes
- [ ] Update routes/web.php to include GET /projects (index), GET /projects/create, POST /projects (store)

## Step 4: Update Projects View
- [ ] Modify resources/views/projects.blade.php to display projects from database
- [ ] Add modal/form for adding new project
- [ ] Use Carbon or similar to display relative time (e.g., "X mins ago")
- [ ] Make "New" button open the modal/form

## Step 5: Run Migration and Test
- [ ] Run `php artisan migrate` to create the projects table
- [ ] Test the functionality by adding a project and verifying automatic time
