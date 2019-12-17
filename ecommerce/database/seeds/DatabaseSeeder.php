<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Comment;
use App\Product;
use App\PurchaseOrder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $products = factory(Product::class)->times(4)->create();
        $comments = factory(Comment::class)->times(4)->create();
        // $purchaseOrders = factory(PurchaseOrder::class)->times(4)->create();

        $users = User::all();

        foreach($products as $product) {
            $product->getCategory()->associate(Category::all()->random(1)->first())->save();
            $product->getUsersWhoHaveSeenIt()->saveMany($users->random(2));
        }

        foreach($purchaseOrders as $purchaseOrder) {
            $purchaseOrder->getUser()->associate($users->random(1)->first())->save();
            $purchaseOrder->getProducts()->saveMany($products->random(2));
            foreach($purchaseOrder->getProducts() as $productInPurchase) {
                $productInPurchase->pivot->quantity = rand(1,5);
                $productInPurchase->save();
            }
        }

        foreach($comments as $comment) {
            $comment->getProduct()->associate($products->random(1)->first())->save();
            $comment->getUSer()->associate($users->random(1)->first())->save();
        }
    }
}
