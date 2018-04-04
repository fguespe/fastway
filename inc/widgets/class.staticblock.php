<?php 
// **********************************************************************// 
// ! Register Nexthemes Widgets
// **********************************************************************// 

class Theshopier_StaticBlock_Widget extends Theshopier_Widget {

    public function __construct() {
        $this->widget_cssclass    = 'nth_stblock_widget';
		$this->widget_description = esc_html__( "Get Static block content", 'theshopier' );
		$this->widget_id          = 'theshopier_stblock';
		$this->widget_name        = esc_html__('Static Blocks', 'theshopier' );
		
		$nexthemes_stblocks = array();
		if( class_exists('Nexthemes_StaticBlock') ) {
			$stblocks = Nexthemes_StaticBlock::getStaticBlocks( array( 'widget', 'all' ) );
			foreach($stblocks as $data){
				$nexthemes_stblocks[$data['slug']] = $data['title'];
			}
		}
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'theshopier' )
			),
			'block_id'  => array(
				'type'  => 'select',
				'std'	=> '',
				'label' => esc_html__( 'Static block', 'theshopier' ),
				'options'	=> $nexthemes_stblocks,
			)
		);
		parent::__construct();
    }

    function widget($args, $instance) {
        extract($args);
        $block_id = $instance['block_id'];
		
		if(class_exists( 'Nexthemes_StaticBlock' )) {
			$this->widget_start( $args, $instance );
			Nexthemes_StaticBlock::getSticBlockContent($block_id);
			$this->widget_end( $args );
		}
    }
}
