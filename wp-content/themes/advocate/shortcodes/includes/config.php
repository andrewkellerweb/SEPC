<?php
/**
 * Define the shortcode parameters
 *
 * @package ZillaShortcodes
 * @since 1.0
 */

// Buttons shortcode config
$zilla_shortcodes['button'] = array(
	'title' => __('Button', 'tzsc'),
	'id' => 'tzsc-button-shortcode',
	'template' => '[button {{attributes}}] {{content}} [/button]',
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'textdomain'),
			'desc' => __('Add the button\'s url eg http://example.com', 'textdomain')
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Button\'s Style', 'textdomain'),
			'desc' => __('Select the button\'s style, ie the buttons color', 'textdomain'),
			'options' => array(
				'white' => 'White',
				'black' => 'Black',
				'green' => 'Green',
				'blue' => 'Blue',
				'teal' => 'Teal',
				'purple' => 'Purple',
				'red' => 'Red',
				'orange' => 'Orange',
				'grey' => 'Grey',
				'blue' => 'Blue'
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __('Button\'s Size', 'textdomain'),
			'desc' => __('Select the button\'s size', 'textdomain'),
			'options' => array(
				'small' => 'Small',
				'large' => 'Large'
			)
		),
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button\'s Text', 'textdomain'),
			'desc' => __('Add the button\'s text', 'textdomain'),
		)
	)
);

// Tabs
$zilla_shortcodes['tabs'] = array(
    'title' => __('Tab', 'tzsc'),
    'id' => 'tzsc-tabs-shortcode',
    'params' => array(
        'tabs' => array(
        		'std' => '',
            'type' => 'text',
            'label' => __('Tab Titles', 'tzsc'),
            'desc' => __('Please enter the tab titles here, seperating each by a comma. They must match the tabs that are created below.', 'tzsc')
        )
    ),
    'template' => '[tabs] {{child_shortcode}}  [/tabs]',
    'notes' => __('Click \'Add Tag\' to add a new tag. Drag and drop to reorder tabs.', 'tzsc'),
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Tab Title', 'tzsc'),
                'desc' => __('Title of the tab.', 'tzsc'),
            ),
            'content' => array(
                'std' => 'Tab Content',
                'type' => 'textarea',
                'label' => __('Tab Content', 'tzsc'),
                'desc' => __('Add the tabs content.', 'tzsc')
            )
        ),
        'template' => '[tab {{attributes}}] {{content}} [/tab]',
        'clone_button' => __('Add Tab', 'tzsc')
    )
);

// Toggle content shortcode config
$zilla_shortcodes['toggle'] = array(
		'title' => __('Toggle', 'tzsc'),
		'id' => 'tzsc-toggle-shortcode',
    'template' => '[toggles] {{child_shortcode}}  [/toggles]',
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Toggle Title', 'eandc'),
                'desc' => __('Title of the toggle', 'eandc'),
            ),
            'content' => array(
                'std' => 'Toggle Content',
                'type' => 'textarea',
                'label' => __('Toggle Content', 'eandc'),
                'desc' => __('Add the toggle content', 'eandc')
            ),
						'opened' => array(
							'type' => 'select',
							'label' => __('Toggle Opened?', 'textdomain'),
							'desc' => __('Open this toggle by default', 'textdomain'),
							'options' => array(
								'false' => 'false',
								'true' => 'true'
							)
						),
        ),
        'template' => '[toggle {{attributes}}] {{content}} [/toggle]',
        'clone_button' => __('Add Toggle', 'eandc')
    )
);

// Columns
$zilla_shortcodes['columns'] = array(
  'title' => __('Columns', 'tzsc'),
  'id' => 'tzsc-columns-shortcode',
  'template' => ' {{child_shortcode}} ', // There is no wrapper shortcode
  'notes' => __('Click \'Add Column\' to add a new column. Drag and drop to reorder columns.', 'tzsc'),
  'params' => array(),
  'child_shortcode' => array(
    'params' => array(
      'column' => array(
        'type' => 'select',
        'label' => __('Column Type', 'tzsc'),
        'desc' => __('Select the width of the column.', 'tzsc'),
        'options' => array(
          'one_third' => __('One Third', 'tzsc'),
          'two_third' => __('Two Thirds', 'tzsc'),
          'one_half' => __('One Half', 'tzsc'),
          'one_fourth' => __('One Fourth', 'tzsc'),
          'three_fourth' => __('Three Fourth', 'tzsc'),
          'one_fifth' => __('One Fifth', 'tzsc'),
          'two_fifth' => __('Two Fifth', 'tzsc'),
          'three_fifth' => __('Three Fifth', 'tzsc'),
          'four_fifth' => __('Four Fifth', 'tzsc'),
          'one_sixth' => __('One Sixth', 'tzsc'),
          'five_sixth' => __('Five Sixth', 'tzsc')
        )
      ),
      'last' => array(
        'type' => 'checkbox',
        'label' => __('Last column', 'tzsc'),
        'desc' => __('Set whether this is the last column.', 'tzsc'),
        'default' => false
      ),
      'content' => array(
        'std' => __('Column content', 'tzsc'),
        'type' => 'textarea',
        'label' => __('Column Content', 'tzsc'),
        'desc' => __('Add the column content.', 'tzsc')
      )
    ),
    'template' => '[column {{attributes}}] {{content}} [/column]',
    'clone_button' => __('Add Column', 'tzsc')
  )
);

?>