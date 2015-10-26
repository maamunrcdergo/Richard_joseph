<?php
add_action('init', 'acpt_profile_init');

function acpt_profile_init() {
    $args_profile = array(
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'hierarchical' => true,
            //'rewrite'=>array('slug'=>'people')
    );
    $profile = acpt_post_type('profile', 'profiles', false, $args_profile)->icon('person');
    acpt_tax('people', 'peoples', $profile, true, false);

    $people_Admin = new Custom_Post_Type_Admin('profile', array('people'));
}

/*
 * Action in Query create
 *
 */
add_action('pre_get_posts', 'profiles_pre_get_posts');

function profiles_pre_get_posts($query) {
    // project example
    if ((isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'profile' ) || !empty($query->query_vars['people'])) {
        $query->set('orderby', 'meta_value_num');
        $query->set('meta_key', 'custom_order');
        $query->set('order', 'ASC');
    }
    // always return
    return $query;
}

//add_action('quick_edit_custom_box', 'profiles_quick_edit_col', 10, 2);

function profiles_quick_edit_col($col, $type) {
    if ($col == 'custom_order') {
        ?>

        <fieldset class="inline-edit-col-left">
            <div class="inline-edit-col">
                <div class="inline-edit-group">
                    <label for="custom_order alignleft">
                        <span class="title">Order</span>
                        <input type="text" name="custom_order" id="custom_order" size="10" value="" maxlength="4" style="width: 100px;" />
                    </label>

                </div>
            </div>
        </fieldset>

        <?php
    } elseif ($col == 'is_featured') {
        ?>

        <fieldset class="inline-edit-col-left">
            <div class="inline-edit-col">
                <div class="inline-edit-group">
                    <label class="alignleft inline-edit-is_featured">
                        <input type="checkbox" value="1" name="is_featured">
                        <span class="checkbox-title">Is Featured</span>
                    </label>

                </div>
            </div>
        </fieldset>

        <?php
    }
}
