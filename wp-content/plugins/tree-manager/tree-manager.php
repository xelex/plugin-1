<?php
/*
Plugin Name: Я Посадил Дерево
Plugin URI: http://япосадилдерево.рф
Description: Управление картой посадок
Version: 0.3
Author: ВБХ
Author URI: http://япосадилдерево.рф/
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Tree_Manager {
    /**
     * Instance of this class.
     *
     * @var static
     */
    protected static $instance;

    /**
     * Constructor.
     *
     * @param mixed
     */
    public function __construct() {
        require dirname( __FILE__ ) . '/includes/helper-functions.php';
        if ( is_admin() ) {
            require dirname( __FILE__ ) . '/includes/admin/class-admin-menu.php';
            require dirname( __FILE__ ) . '/includes/admin/type/types-functions.php';
            require dirname( __FILE__ ) . '/includes/admin/tree/trees-functions.php';
            require dirname( __FILE__ ) . '/includes/admin/activity/activities-functions.php';
            require dirname( __FILE__ ) . '/includes/admin/plantator/plantators-functions.php';

            new Admin_Menu();
        }

        // MAP-related things
        wp_enqueue_script('yandex-map', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU');
        wp_enqueue_script('yandex-round', url_simplify(plugin_dir_url( __FILE__).'/js/map-round.js'));
        wp_enqueue_script('qr-canvas', url_simplify(plugin_dir_url( __FILE__).'/js/qrcanvas.packed.js'));
        wp_enqueue_style( 'style', url_simplify(plugin_dir_url( __FILE__).'/css/tree-manager.css'));

        add_shortcode( 'yandex_map', array('Tree_Manager', 'map_function') );

        register_activation_hook( __FILE__, array( $this, 'create_table' ) );
    }

    /**
     * Map functions shortcut.
     *
     * @return object
     */
    function map_function( $atts ) {
        include(dirname( __FILE__ ) . '/includes/map/geo.php');
        return geo_container();
    }

    /**
     * Singleton instance.
     *
     * @return object
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Table cleanup functions
     */
    private function uninstall_tree_manager_do($name) {
        global $wpdb;

        $table_name = $wpdb->prefix.$name;
        $wpdb->query("DROP TABLE IF EXISTS $table_name");
    }

    /**
     * Create relevant table.
     */
    public function create_table() {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        global $wpdb;

        // DROP
        $this->uninstall_tree_manager_do("trees");
        $this->uninstall_tree_manager_do("plantators");
        $this->uninstall_tree_manager_do("activities");
        $this->uninstall_tree_manager_do("types");

        // CREATE
        $charset_collate = $wpdb->get_charset_collate();
        
        $types_name = $wpdb->prefix . 'types';
        $sql = "CREATE TABLE IF NOT EXISTS $types_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            
            name varchar(255) NOT NULL,
            icon int(11) DEFAULT 0 NOT NULL,
            description text DEFAULT '' NOT NULL,

            date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY id (id)
        ) ENGINE=INNODB $charset_collate;";
        dbDelta( $sql );

        //TODO: remove
        if (false) {
            $plant_name = $wpdb->prefix . 'plantators';
            $sql = "CREATE TABLE IF NOT EXISTS $plant_name (
                id int(11) NOT NULL AUTO_INCREMENT,
                
                name text DEFAULT '' NOT NULL,
                when datetime DEFAULT AUTO_INCREMENT NOT NULL,
                phone varchar(255) DEFAULT '' NOT NULL,
                email varchar(255) DEFAULT '' NOT NULL,
                fb varchar(255) DEFAULT NULL,
                vk varchar(255) DEFAULT NULL,
                tw varchar(255) DEFAULT NULL,
                ig varchar(255) DEFAULT NULL,
                description text DEFAULT '' NOT NULL,

                date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY id (id)
            ) ENGINE=INNODB $charset_collate;";
            dbDelta( $sql );
        }

        $act_name = $wpdb->prefix . 'activities';
        $sql = "CREATE TABLE IF NOT EXISTS $act_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            
            name text DEFAULT '' NOT NULL,
            total int(11) DEFAULT 0 NOT NULL,
            type_id int(11) DEFAULT NULL,
            lat DOUBLE DEFAULT NULL,
            lng DOUBLE DEFAULT NULL,
            location varchar(255) DEFAULT '' NOT NULL,
            `when` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
            description text DEFAULT '' NOT NULL,

            global INT DEFAULT 0 NOT NULL,
            date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY id (id),

            FOREIGN KEY (type_id)
                REFERENCES {$types_name}(id)
                ON DELETE CASCADE
        ) ENGINE=INNODB $charset_collate;";
        dbDelta( $sql );

        $trees_name = $wpdb->prefix . 'trees';
        $sql = "CREATE TABLE IF NOT EXISTS $trees_name (
            id int(11) NOT NULL AUTO_INCREMENT,

            lat DOUBLE DEFAULT 0 NOT NULL,
            lng DOUBLE DEFAULT 0 NOT NULL,
            approved INT DEFAULT 0 NOT NULL,
            action_id int(11),
            owner_id int(11),
            type_id int(11),

            amount int(11) DEFAULT 0 NOT NULL,
            description TEXT DEFAULT '' NOT NULL,
            url varchar(255) DEFAULT '' NOT NULL,

            planted DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
            last DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

            date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY id (id),

            FOREIGN KEY (type_id)
                REFERENCES {$types_name}(id)
                ON DELETE CASCADE,
            FOREIGN KEY (action_id)
                REFERENCES {$act_name}(id)
                ON DELETE CASCADE
        ) ENGINE=INNODB $charset_collate;";
        dbDelta( $sql );
        
        $this->seed();
    }

    private function seed() {
        global $wpdb;

    $TYPES_0 = <<<END
Дуб (Quercus)
Ясень (Fraxinus)
Вяз, ильм, берест (Ulmus)
Каштан посевной (Castanea sativa)
Бархатное дерево (Pheilodendron amurense)
Фисташка (Pistacia)
Акация белая (Robinia pseudoacacia)
Береза (Betula)
Осина обыкновенная (Populus tremula)
Бук (Fagus)
Липа (Tilia)
Ольха (Alnus)
Тополь (Populus)
Граб обыкновенный (Carpinus betulus)
Клен (Acer)
Ива (Salix)
Орех (Juglans)
Платан восточный, чинар, (Platanus orientalis)
Груша обыкновенная (Pyms communis)
Самшит вечнозеленый (Buxus sempervirens)
Рябина обыкновенная (Sorbus aucuparia)
Лещина обыкновенная, орешник (Colypus avellana)
Железное дерево или парротия персидская (Parrotia persica)
Гледичия обыкновенная (Gleditsia triacanthos)
Карельская береза (Betula pendula var. carelica)
END;
    $TYPES_1 = <<<END
Лиственница (Larix)
Сосна (Pinus)
Ель (Picea)
Пихта (Abies)
Кедр (Pinus)
Можжевельник (Juniperus)
Тис (Taxus)
END;
        // Adding types
        foreach(array_map('trim', explode("\n", $TYPES_0)) as $name) {
            if (strlen($name) > 1) {
                $sql = "INSERT INTO ".$wpdb->prefix."types (name, icon) values ('$name', 0)";
                dbDelta( $sql );
            }
        }

        foreach(array_map('trim', explode("\n", $TYPES_1)) as $name) {
            if (strlen($name) > 1) {
                $sql = "INSERT INTO ".$wpdb->prefix."types (name, icon) values ('$name', 1)";
                dbDelta( $sql );
            }
        }

        if (false) {
            // Adding activity
            foreach(range(1, 10) as $index) {
                $name = 'Акция '.$index;
                $global = rand(0, 1);
                $sql = "INSERT INTO ".$wpdb->prefix."activities (name, type_id, lat, lng, global) values ('$name', NULL, NULL, NULL, $global)";
                dbDelta( $sql );
            }

            // Adding trees
            foreach(range(1, 1000) as $index) {
                $lat_base = 55.76 + (rand(0, 10000) - 5000) * 0.2 / 10000;
                $lng_base = 37.64 + (rand(0, 10000) - 5000) * 0.2 / 10000;
                $approved = rand(0, 1);
                $type_id = rand(1, 30);
                $url = 'type_'.$index;
                $action_id = rand(1, 10);
                $sql = "INSERT INTO ".$wpdb->prefix."trees (lat, lng, action_id, owner_id, type_id, approved, url) values ".
                    "($lat_base, $lng_base, $action_id, 0, $type_id, $approved, '$url')";
                dbDelta( $sql );
            }

            // Adding trees
            foreach(range(1, 100) as $index) {
                $lat_base = 55.76 + 0.2 + 0.2 * (rand(5000, 10000) - 5000) / 10000;
                $lng_base = 37.64 + 0.2 + 0.2 * (rand(5000, 10000) - 5000) / 10000;
                $type_id = rand(1, 30);
                $action_id = rand(1, 10);
                $amount =rand(1, 5000);
                $sql = "INSERT INTO ".$wpdb->prefix."trees (lat, lng, action_id, owner_id, type_id, approved, amount) values ".
                    "($lat_base, $lng_base, $action_id, 0, $type_id, 1, $amount)";
                dbDelta( $sql );
            }
        }
    }
}

Tree_Manager::get_instance();