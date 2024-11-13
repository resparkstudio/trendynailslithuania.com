<nav id="desktop-sidebar-navigation"
    class="main-navigation body-small-regular text-white flex flex-col md:hidden row-span-9 pl-12 pr-4 py-9">
    <?php
    $locations = get_nav_menu_locations();

    if (isset($locations['sidebar-menu'])) {
        $menu_id = $locations['sidebar-menu'];
        $menu_items = wp_get_nav_menu_items($menu_id);
        $menu_items_by_parent = [];

        foreach ($menu_items as $item) {
            $menu_items_by_parent[$item->menu_item_parent][] = $item;
        }

        echo '<ul id="primary-sidebar-menu" class="flex flex-col main-menu-fluid-spacing gap-5 overflow-auto pr-4">';

        function display_menu_items($parent_id, $menu_items_by_parent, $is_submenu = false)
        {
            if (!isset($menu_items_by_parent[$parent_id])) {
                return;
            }

            foreach ($menu_items_by_parent[$parent_id] as $item) {
                $classes = 'flex items-center justify-between cursor-pointer sidebar-toggle-menu';
                $has_children = isset($menu_items_by_parent[$item->ID]);

                echo '<li>';

                // Check if the item is a product category
                $is_product_category = ($item->type === 'taxonomy' && $item->object === 'product_cat');

                // If the item has children, handle the submenu
                if ($has_children) {
                    echo '<a href="' . ($is_product_category ? 'javascript:void(0);' : esc_url($item->url)) . '" class="' . esc_attr($classes) . '" data-has-children="true">';
                    echo '<div class="flex-grow"><span class="link-hover">' . $item->title . '</span></div>';
                    echo '<div class="icon flex items-center justify-end">
                        <svg class="sidebar-more-icon menu-icon-rotate" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 4.5L0.621716 0L0 0.639L1.50613 2.178L3.76532 4.5L1.50613 6.822L0.00875641 8.361L0.630473 9L5 4.5Z" fill="white"/>
                        </svg>
                    </div>';
                    echo '</a>';

                    // Submenu
                    echo '<ul class="pt-5 gap-5 flex-col submenu hidden">';

                    // Add "Visi produktai" only if it's a product category
                    if ($is_product_category) {
                        echo '<li><a href="' . esc_url($item->url) . '" class="pl-2">Visi produktai</a></li>';
                    }

                    // Display one level of subcategories
                    foreach ($menu_items_by_parent[$item->ID] as $child) {
                        echo '<li><a href="' . esc_url($child->url) . '" class="pl-2">' . $child->title . '</a></li>';
                    }

                    echo '</ul>';
                } else {
                    // Standard menu item with no children
                    echo '<a href="' . esc_url($item->url) . '" class="' . esc_attr($classes) . '" data-has-children="false">';
                    echo '<div class="flex-grow"><span class="link-hover">' . $item->title . '</span></div>';
                    echo '</a>';
                }

                echo '</li>';
            }
        }

        display_menu_items(0, $menu_items_by_parent);
        echo '</ul>';
    }
    ?>
</nav>