<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuItem;

class MenuSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->command->info('Truncating Menu, MenuItem tables');
        Schema::disableForeignKeyConstraints();
        MenuItem::truncate();
        Menu::truncate();
        Schema::enableForeignKeyConstraints();

        // Create a new menu
        $this->command->info('Creating Menu');

        $category = Menu::create([
            'name'          => 'main-menu',
            'created_at'    => Carbon::now()
        ]);
        $category = Menu::create([
            'name'          => 'footer-menu',
            'created_at'    => Carbon::now()
        ]);

        // Create menuitem for Main Menu
        $this->command->info('Creating MenuItem for Main Menu');

        $menu = Menu::where('name', 'main-menu')->firstOrFail();

        // Trang chủ
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Trang chủ',
            'url'     => '',
            'route'   => 'katitheme.homepage',
            'type'    => 'route'
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        // Giới thiệu
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Giới thiệu',
            'url'     => 'http://katicms.local/gioi-thieu.html',
            'route'   => '',
            'type'    => 'url'
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }

        // Tin tức
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Tin tức',
            'url'     => 'http://katicms.local/tin-tuc.html',
            'route'   => '',
            'type'    => 'url'
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => null,
                'order'      => 3,
            ])->save();
        }

        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Trong nước',
            'url'     => 'https://google.com.vn',
            'route'   => '',
            'type'    => 'url'
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => $menuItem->id,
                'order'      => 1,
            ])->save();
        }

        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Thế giới',
            'url'     => 'https://google.com.vn',
            'route'   => '',
            'type'    => 'url'
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => $menuItem->id,
                'order'      => 2,
            ])->save();
        }

        // Liên hệ
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Liên hệ',
            'url'     => 'http://katicms.local/lien-he.html',
            'route'   => '',
            'type'    => 'url'
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => null,
                'order'      => 4,
            ])->save();
        }

        // Create menuitem for Footer Menu
        $this->command->info('Creating MenuItem for Footer Menu');

        $footer_menu = Menu::where('name', 'footer-menu')->firstOrFail();

        // Dịch vụ
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $footer_menu->id,
            'title'   => 'Dịch vụ',
            'url'     => '#',
            'route'   => '',
            'type'    => 'url'
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => null,
                'order'      => 5,
            ])->save();
        }
        // Tuyển dụng
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $footer_menu->id,
            'title'   => 'Tuyển dụng',
            'url'     => '#',
            'route'   => '',
            'type'    => 'url'
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => null,
                'order'      => 6,
            ])->save();
        }

        // Liên hệ
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $footer_menu->id,
            'title'   => 'Liên hệ',
            'url'     => '#',
            'route'   => '',
            'type'    => 'url'
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => '#333333',
                'parent_id'  => null,
                'order'      => 7,
            ])->save();
        }
    }
}
