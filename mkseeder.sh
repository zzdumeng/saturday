# AddressesTableSeeder
# BillsTableSeeder
# BilltypesTableSeeder
# CartitemsTableSeeder
# CartsTableSeeder
# CategoriesTableSeeder
# CategoryProductTableSeeder
# CitiesTableSeeder
# FavoritesTableSeeder
# FootprintsTableSeeder
# MessagesTableSeeder
# OrderitemsTableSeeder
# OrdersTableSeeder
# PaymentsTableSeeder
# ProductsTableSeeder
# ProvincesTableSeeder
# RegionsTableSeeder
# ReviewsTableSeeder
# SellersTableSeeder
# TagsTableSeeder
# TagProductTableSeeder
# UsersTableSeeder
# $seeders=(\
# AddressesTableSeeder\
#  BillsTableSeeder \
# BilltypesTableSeeder \
# CartitemsTableSeeder \
# CartsTableSeeder \
# CategoriesTableSeeder \
# CategoryProductTableSeeder \
# CitiesTableSeeder \
# FavoritesTableSeeder \
# FootprintsTableSeeder \
# MessagesTableSeeder \
# OrderitemsTableSeeder \
# OrdersTableSeeder \
# PaymentsTableSeeder \
# # ProductsTableSeeder \
# ProvincesTableSeeder \
# RegionsTableSeeder \
# ReviewsTableSeeder \
# SellersTableSeeder \
# TagsTableSeeder \
# TagProductTableSeeder \
# # UsersTableSeeder \
# )
seeders=(AddressesTableSeeder BillsTableSeeder BilltypesTableSeeder CartitemsTableSeeder CartsTableSeeder CategoriesTableSeeder CategoryProductTableSeeder CitiesTableSeeder FavoritesTableSeeder FootprintsTableSeeder  MessagesTableSeeder  OrderitemsTableSeeder  OrdersTableSeeder  PaymentsTableSeeder   ProvincesTableSeeder  RegionsTableSeeder  ReviewsTableSeeder  SellersTableSeeder  TagsTableSeeder  TagProductTableSeeder)
for seed in $seeders
do
  php  artisan make:seeder $seed
done 