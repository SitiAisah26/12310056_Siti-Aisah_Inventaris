# Inventaris-UKK Task Progress

## Completed:
- [x] Fixed APP_KEY
- [x] Created Category/Item models  
- [x] Created CategoryController (full CRUD)
- [x] Created create_categories_table migration
- [x] Created create_items_table migration
- [x] Ran `php artisan migrate` (all tables created)
- [x] Fixed Item model typos (category_id, category relationship)
- [x] Fixed Item model formatting

## Remaining:
- [ ] Create missing item views: items/index.blade.php, items/create.blade.php, items/show.blade.php, items.lendings.blade.php (copy pattern from categories)
- [ ] Add @csrf, Category dropdown to item forms
- [ ] Seed sample data: `php artisan make:seeder CategorySeeder && php artisan db:seed`
- [ ] Test full CRUD at /categories and /items
- [ ] Setup authentication (login/register using SB-Admin)
- [ ] Route cache optional

## Completed:
- [x] Complete ItemController CRUD + lendings (placeholder)

Next: Create missing item views.

