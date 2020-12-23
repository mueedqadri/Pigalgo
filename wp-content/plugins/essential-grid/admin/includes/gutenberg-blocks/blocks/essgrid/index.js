/**
 * Block dependencies
 */
import './style.scss';

/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { TextControl, Button } = wp.components;
const { Component } = wp.element;

/**
 * essgrid Editor Element
 */
export  class EssGrid extends Component {

    constructor() {
        super( ...arguments );
        const { attributes: { text,gridTitle } } = this.props;
        this.state = {
          text ,
          gridTitle
        }
    }

    render() {
        const {
        attributes: { text,gridTitle },
        setAttributes  } = this.props;
      
        window.essgrid_react = this;
        const openDialog = () => {
          jQuery('select[name="ess-grid-existing-grid"]').val("-1");
          jQuery('#ess-grid-tiny-mce-dialog').dialog({
            id       : 'ess-grid-tiny-mce-dialog',
            title	 : eg_lang.shortcode_generator,
            width    : 720,
            height   : 'auto'
          });
        }

        return (
          <div className="essgrid_block" >
                  <span>{this.state.gridTitle}&nbsp;</span>
                  <TextControl
                        className="grid_slug"
                        value={ this.state.text }
                        onChange={ ( text ) => setAttributes( { text } ) }
                    />
                  <Button 
                        isDefault
                        onClick = { openDialog } 
                        className="grid_edit_button"
                    >
                    {__( 'Edita', 'essgrid' )}
                  </Button>
          </div>
        );
    }
}


/**
 * Register block
 */
export default registerBlockType(
    'themepunch/essgrid',
    {
        title: __( 'Add prefined EssGrid', 'essgrid' ),
        description: __( 'Add your predefined Essential Grid.', 'essgrid' ),
        category: 'themepunch',
        icon: {
          src:  'screenoptions',
          background: 'rgb(210,0,0)',
          color: 'white'
        },        
        keywords: [
            __( 'image', 'essgrid' ),
            __( 'gallery', 'essgrid' ),
            __( 'grid', 'essgrid' ),
        ],
        attributes: {
          text: {
              selector: '.essgrid',
              type: 'string',
              source: 'text',
          },
          gridTitle: {
              selector: '.essgrid',
              type: 'string',
              source: 'attribute',
             	attribute: 'data-gridtitle',
          }
        },
        edit: props => {
          const { setAttributes } = props;
          return (
            <div>
              <EssGrid {...{ setAttributes, ...props }} />
            </div>
          );
        },
        save: props => {
          const { attributes: { text,gridTitle } } = props;
          return (
            <div className="essgrid" data-gridtitle={gridTitle}>
               {text} 
            </div>
          );
        },
    },
);