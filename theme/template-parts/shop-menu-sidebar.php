<?php

$facebook_link = get_field('facebook_link', 'option');
$instagram_link = get_field('instagram_link', 'option');
?>
<!-- Sidebar -->
<aside id="shop-sidebar"
    class="shop-sidebar flex-col fixed left-0 w-[16.5rem] md:w-[14.25rem] h-svh bg-black text-white body-small-regular hidden z-40 pt-20 md:pt-[3.75rem] grid-rows-12">
    <nav id="desktop-sidebar-navigation"
        class="main-navigation body-small-regular text-white flex flex-col md:hidden row-span-9 pl-12 pr-4 py-9">
        <?php
        $locations = get_nav_menu_locations();

        if (isset($locations['sidebar-menu'])) {
            $menu_id = $locations['sidebar-menu'];
            $menu_items = wp_get_nav_menu_items($menu_id);
            $menu_items_by_parent = [];

            // Organize menu items by parent ID
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
                    echo '<a href="' . esc_url($item->url) . '" class="' . esc_attr($classes) . '" data-has-children="' . ($has_children ? 'true' : 'false') . '">';
                    echo '<div class="flex-grow">' . '<span class="link-hover">' . $item->title . '</span>' . '</div>';

                    if ($has_children) {
                        echo '<div class="icon flex items-center justify-end">
                            <svg class="sidebar-more-icon menu-icon-rotate" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 4.5L0.621716 0L0 0.639L1.50613 2.178L3.76532 4.5L1.50613 6.822L0.00875641 8.361L0.630473 9L5 4.5Z" fill="white"/>
                            </svg>
                        </div>';
                    }

                    echo '</a>';

                    if ($has_children) {
                        echo '<ul class="pt-5 gap-5 flex-col submenu hidden">'; // Apply submenu and hidden classes here
                        display_menu_items($item->ID, $menu_items_by_parent, true);
                        echo '</ul>';
                    }

                    echo '</li>';
                }
            }

            display_menu_items(0, $menu_items_by_parent);
            echo '</ul>';
        }
        ?>
    </nav>


    <nav id="mobile-sidebar-navigation"
        class="main-navigation body-small-regular text-white flex-col hidden md:flex row-span-10 pt-6 pl-8 pr-10">
        <?php
        if (isset($locations['mobile-sidebar-menu'])) {
            $menu_id = $locations['mobile-sidebar-menu'];
            $menu_items = wp_get_nav_menu_items($menu_id);
            $menu_items_by_parent = [];

            // Organize menu items by parent ID
            foreach ($menu_items as $item) {
                $menu_items_by_parent[$item->menu_item_parent][] = $item;
            }

            echo '<ul id="mobile-primary-menu" class="flex flex-col overflow-y-auto overflow-x-hidden main-menu-fluid-spacing gap-5 pr-10">';

            function display_mobile_menu_items($parent_id, $menu_items_by_parent, $is_submenu = false)
            {
                if (!isset($menu_items_by_parent[$parent_id])) {
                    return;
                }

                foreach ($menu_items_by_parent[$parent_id] as $item) {
                    $classes = 'flex items-center justify-between cursor-pointer sidebar-toggle-menu';
                    $has_children = isset($menu_items_by_parent[$item->ID]);

                    echo '<li>';
                    echo '<a href="' . esc_url($item->url) . '" class="' . esc_attr($classes) . '" data-has-children="' . ($has_children ? 'true' : 'false') . '">';
                    echo '<div class="flex-grow">' . '<span class="link-hover">' . $item->title . '</span>' . '</div>';

                    if ($has_children) {
                        echo '<div class="icon flex items-center justify-end">
                        <svg class="sidebar-more-icon menu-icon-rotate" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 4.5L0.621716 0L0 0.639L1.50613 2.178L3.76532 4.5L1.50613 6.822L0.00875641 8.361L0.630473 9L5 4.5Z" fill="white"/>
                        </svg>
                    </div>';
                    }

                    echo '</a>';

                    if ($has_children) {
                        echo '<ul class="pt-5 gap-5 flex-col submenu hidden">'; // Similar classes for the submenu
                        display_mobile_menu_items($item->ID, $menu_items_by_parent, true);
                        echo '</ul>';
                    }

                    echo '</li>';
                }
            }

            display_mobile_menu_items(0, $menu_items_by_parent);
            echo '</ul>';
        }
        ?>
    </nav>

    <div
        class="sidebar-footer px-12 pb-11 md:px-8 md:pb-6 flex flex-col justify-end row-span-3 md:row-span-2 gap-2.5 md:gap-2">
        <p class="w-full md:font-normal md:text-[0.75rem] body-small-light">
            <?php echo wp_kses_post('Sekite mūsų naujienas!'); ?>
        </p>
        <div class="flex gap-4 w-full">
            <?php if ($facebook_link): ?>
                <a href="<?php echo esc_url($facebook_link); ?>" target="_blank" class="text-white">
                    <svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.47636 9L7.88364 6.125H5.29455V4.25C5.29455 3.4375 5.64364 2.6875 6.80727 2.6875H8V0.21875C8 0.21875 6.92364 0 5.90545 0C3.78182 0 2.38545 1.40625 2.38545 3.90625V6.125H0V9H2.38545V16H5.29455V9H7.47636Z"
                            fill="white" />
                    </svg>
                </a>
            <?php endif; ?>

            <?php if ($instagram_link): ?>
                <a href="<?php echo esc_url($instagram_link); ?>" target="_blank" class="text-white">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.01786 3.875C10.2679 3.875 12.125 5.73214 12.125 7.98214C12.125 10.2679 10.2679 12.0893 8.01786 12.0893C5.73214 12.0893 3.91071 10.2679 3.91071 7.98214C3.91071 5.73214 5.73214 3.875 8.01786 3.875ZM8.01786 10.6607C9.48214 10.6607 10.6607 9.48214 10.6607 7.98214C10.6607 6.51786 9.48214 5.33929 8.01786 5.33929C6.51786 5.33929 5.33929 6.51786 5.33929 7.98214C5.33929 9.48214 6.55357 10.6607 8.01786 10.6607ZM13.2321 3.73214C13.2321 4.26786 12.8036 4.69643 12.2679 4.69643C11.7321 4.69643 11.3036 4.26786 11.3036 3.73214C11.3036 3.19643 11.7321 2.76786 12.2679 2.76786C12.8036 2.76786 13.2321 3.19643 13.2321 3.73214ZM15.9464 4.69643C16.0179 6.01786 16.0179 9.98214 15.9464 11.3036C15.875 12.5893 15.5893 13.6964 14.6607 14.6607C13.7321 15.5893 12.5893 15.875 11.3036 15.9464C9.98214 16.0179 6.01786 16.0179 4.69643 15.9464C3.41071 15.875 2.30357 15.5893 1.33929 14.6607C0.410714 13.6964 0.125 12.5893 0.0535714 11.3036C-0.0178571 9.98214 -0.0178571 6.01786 0.0535714 4.69643C0.125 3.41071 0.410714 2.26786 1.33929 1.33929C2.30357 0.410714 3.41071 0.125 4.69643 0.0535714C6.01786 -0.0178571 9.98214 -0.0178571 11.3036 0.0535714C12.5893 0.125 13.7321 0.410714 14.6607 1.33929C15.5893 2.26786 15.875 3.41071 15.9464 4.69643ZM14.2321 12.6964C14.6607 11.6607 14.5536 9.16071 14.5536 7.98214C14.5536 6.83929 14.6607 4.33929 14.2321 3.26786C13.9464 2.58929 13.4107 2.01786 12.7321 1.76786C11.6607 1.33929 9.16071 1.44643 8.01786 1.44643C6.83929 1.44643 4.33929 1.33929 3.30357 1.76786C2.58929 2.05357 2.05357 2.58929 1.76786 3.26786C1.33929 4.33929 1.44643 6.83929 1.44643 7.98214C1.44643 9.16071 1.33929 11.6607 1.76786 12.6964C2.05357 13.4107 2.58929 13.9464 3.30357 14.2321C4.33929 14.6607 6.83929 14.5536 8.01786 14.5536C9.16071 14.5536 11.6607 14.6607 12.7321 14.2321C13.4107 13.9464 13.9821 13.4107 14.2321 12.6964Z"
                            fill="white" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</aside>