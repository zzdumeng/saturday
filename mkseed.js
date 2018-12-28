const {spawn} = require('child_process')
const seeders = [
// AddressesTableSeeder
, 'BillsTableSeeder'
, 'BilltypesTableSeeder'
, 'CartitemsTableSeeder'
, 'CartsTableSeeder'
, 'CategoriesTableSeeder'
, 'CategoryProductTableSeeder'
, 'CitiesTableSeeder'
, 'FavoritesTableSeeder'
, 'FootprintsTableSeeder'
, 'MessagesTableSeeder'
, 'OrderitemsTableSeeder'
, 'OrdersTableSeeder'
, 'PaymentsTableSeeder'
, 'ProductsTableSeeder'
, 'ProvincesTableSeeder'
, 'RegionsTableSeeder'
, 'ReviewsTableSeeder'
, 'SellersTableSeeder'
, 'TagsTableSeeder'
, 'TagProductTableSeeder'
, 'UsersTableSeeder'

]
seeders.forEach((s) => {
  spawn('php' ,['artisan', 'make:seeder', s])
})