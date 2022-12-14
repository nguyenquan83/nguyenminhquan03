const { registerBlockType, createBlock } = wp.blocks,
	{ createElement:el, Component, RawHTML } = wp.element,
	{ string: shortcodeToString, next } = wp.shortcode,

	hustlePopupTriggerIconEl =
		el('svg', {
			class: 'dashicon', viewBox: '0 0 24 24',  width: 24, height: 24, xmlns: 'http://www.w3.org/2000/svg', preserveAspectRatio: 'xMidYMid meet', 'aria-hidden': 'true', role: 'img'
		},
			el (
				'path', {
					d: 'M3.5 8.69063V8C3.5 7.725 3.72375 7.5 4 7.5H16C16.275 7.5 16.5 7.725 16.5 8V8.69063L15.7937 9.26875C16.3312 9.09375 16.8781 9 17.5 9C17.6687 9 17.8344 9.00625 18 9.02187V8C18 6.89531 17.1031 6 16 6H4C2.89531 6 2 6.89531 2 8V16C2 17.1031 2.89531 18 4 18H13.2562C12.8875 17.5531 12.5875 17.0469 12.3469 16.5H4C3.72375 16.5 3.5 16.275 3.5 16V10.6312L7.90937 14.275C9.11562 15.2437 10.8062 15.2594 12.0031 14.325C12.0312 13.4125 12.2812 12.5563 12.7 11.8094L11.1094 13.1156C10.4656 13.6469 9.53437 13.6469 8.89062 13.1156L3.5 8.69063Z'
				}
			),
			el (
				'path', {
					'fill-rule': "evenodd",
					'clip-rule': "evenodd",
					d: 'M22 14.45C22 16.9629 19.9853 19 17.5 19C15.0147 19 13 16.9629 13 14.45C13 11.9371 15.0147 9.9 17.5 9.9C19.9853 9.9 22 11.9371 22 14.45ZM18.6276 12.2782C18.9066 11.9962 19.3588 11.9962 19.6378 12.2782C19.9167 12.5602 19.9167 13.0175 19.6378 13.2996L18.5101 14.4397L19.6479 15.5902C19.9269 15.8722 19.9269 16.3295 19.6479 16.6115C19.369 16.8936 18.9167 16.8936 18.6378 16.6115L17.5 15.4611L16.3622 16.6115C16.0833 16.8936 15.631 16.8936 15.3521 16.6115C15.0731 16.3295 15.0731 15.8722 15.3521 15.5902L16.4898 14.4397L15.3622 13.2996C15.0833 13.0175 15.0833 12.5602 15.3622 12.2782C15.6412 11.9962 16.0934 11.9962 16.3724 12.2782L17.5 13.4184L18.6276 12.2782Z'
				}
			),
		);

/**
 * Block edit class
 */
class Hustle_Unsubscribe_BlockEdit extends Component {
	/**
	 * Class constructor
	 */
	constructor() {
		super( ...arguments );

		this.update_id = this.update_id.bind( this );
		this.update_skip = this.update_skip.bind( this );

		this.state = {
			loading: false,     // Set to true while loading preview markup
			markup: ''          // Preview markup
		};
	}

	/**
	 * Update shortcode id
	 */
	update_id( id ) {
		this.props.setAttributes( { id } );
	}

	/**
	 * Update shortcode skip confirmation attribute
	 */
	update_skip( skipConfirmation ) {
		this.props.setAttributes( { skipConfirmation } );
	}

	/**
	 * Preview shortcode
	 */
	preview( attributes ) {
		const { id, skipConfirmation } = attributes;

		// Check if we already process ajax request
		if ( this.state.loading ) {
			// Ajax request in process, skip
			return;
		}

		// Set loading to true
		this.setState({ loading: true });

		let ajax_url = ajaxurl + '?action=hustle_render_unsubscribe_form&_wpnonce=' + hustle_unsubscribe_data.nonce;

		if ( id ) {
			ajax_url += '&module_ids=' + id;
		}

		if ( skipConfirmation ) {
			ajax_url += '&skip_confirmation=' + skipConfirmation;
		}

		window.fetch( ajax_url )
			.then( response => response.json() )
			.then( data => {

				if ( data.success ) {
					const html = data.data;

					this.setState({
						markup: html,
						loading: false
					});

					this.update_id( id );
					this.update_skip( skipConfirmation );
				}

			})
			.catch( error => {
				console.log( error );
			})

		;

	}

	/**
	 * React method called when block is initialized.
	 * Used to get the module_id when only the shortcode_id is provided.
	 */
	componentDidUpdate( prevProps ) {
		const { attributes } = this.props;
		let { id, skipConfirmation } = attributes;

		if( prevProps.attributes.id === id && prevProps.attributes.skipConfirmation === skipConfirmation ) {
			return;
		}

		// Load preview
		this.preview( attributes );
	}

	/**
	 * React method called when block is initialized.
	 * Used to get the module_id when only the shortcode_id is provided.
	 */
	componentDidMount() {
		const { attributes } = this.props;

		// Load preview
		this.preview( attributes );

	}

	open_settings() {
		window.open( hustle_unsubscribe_data.settings_url );
	}

	/**
	 * Render
	 */
	render() {

		const
			{ loading, markup } = this.state,
			{ attributes, isSelected } = this.props,
			{ id, skipConfirmation } = attributes,
			open_settings = ( e ) => this.open_settings(),
			popups = hustle_unsubscribe_data.popups,
			slideins = hustle_unsubscribe_data.slideins,
			embeds = hustle_unsubscribe_data.embeds;

		const HustleModules = () => {
			return (
				<React.Fragment>
					<optgroup label={ hustle_unsubscribe_data.l10n.popups }>
						{ _.map( popups, ( field, x ) => (
							<option value={ field.value } key={ field.value }>
								{ field.label }
							</option>
						) ) }
					</optgroup>
					<optgroup label={ hustle_unsubscribe_data.l10n.slideins }>
						{ _.map( slideins, ( field, x ) => (
							<option value={ field.value } key={ field.value }>
								{ field.label }
							</option>
						) ) }
					</optgroup>
					<optgroup label={ hustle_unsubscribe_data.l10n.embeds }>
						{ _.map( embeds, ( field, x ) => (
							<option value={ field.value } key={ field.value }>
								{ field.label }
							</option>
						) ) }
					</optgroup>
				</React.Fragment>
			);
		};

		const controls = [ isSelected && el (
			wp.blockEditor.InspectorControls,
			{ key: 'inspector' },
			el (
				wp.components.PanelBody,
				{
					title: hustle_unsubscribe_data.l10n.modules,
					initialOpen: true
				},
				el (
					wp.components.PanelRow,
					null,
					el ( wp.components.SelectControl, {
						help: hustle_unsubscribe_data.l10n.block_instruction,
						value: id,
						children: <HustleModules />,
						multiple: true,
						className: 'hustle-unsubscribe-block-settings',
						onChange: this.update_id
					})
				),
				el (
					wp.components.PanelRow,
					null,
					el ( wp.components.CheckboxControl, {
						label: hustle_unsubscribe_data.l10n.skip_confirmation,
						checked: skipConfirmation,
						onChange: this.update_skip
					})
				)
			)
		), el ( wp.blockEditor.BlockControls,
			null,
			el ( wp.components.ToolbarGroup,
				null,
				el ( wp.components.ToolbarButton, {
					className: 'components-toolbar__control',
					label: hustle_unsubscribe_data.l10n.customize_settings,
					icon: 'edit',
					onClick: open_settings
				})
			)
		)];

		// If preview is being loaded, show spinner
		if( loading ) {
			return [ controls, el ( 'div',
				{ key: 'loading', className: 'wp-block-embed is-loading' },
				el ( wp.components.Spinner, null ),
				el ( 'span',
					null,
					hustle_unsubscribe_data.l10n.rendering
				)
			)];
		}

		return [
			controls, el ( RawHTML,
				null,
				markup
			)];
	}
}

registerBlockType( 'hustle/unsubscribe', {
	title: hustle_unsubscribe_data.l10n.block_name,
	description: hustle_unsubscribe_data.l10n.block_description,
    icon: hustlePopupTriggerIconEl,
	category: 'hustle',
	keywords: [ 'Hustle', hustle_unsubscribe_data.l10n.block_name ],
	attributes: {
		id: {
			type: 'array'
		},
		skipConfirmation: {
			type: 'bool'
		}
	},
	supports:    {
		customClassName: false,
		className:       false,
		html:            false,
	},
	transforms: {
		to: [
			{
				type: 'block',
				blocks: [ 'core/shortcode' ],
				transform: ( { id, skipConfirmation } ) => {
					let attrs = {};

					if ( id && JSON.stringify( [] ) !== JSON.stringify( id ) ) {
						attrs.id = id;
					}

					if ( skipConfirmation ) {
						attrs.skip_confirmation = skipConfirmation;
					}

					let options = {
						tag: hustle_unsubscribe_data.shortcode_tag,
						attrs,
						type: 'single'
					};

					let text = shortcodeToString( options );
					return createBlock( 'core/shortcode', {
						text,
					} );
				},
			},
		],

		from: [

			{
				type: 'block',
				blocks: [ 'core/shortcode' ],
				isMatch( { text } ) {
					let found_shortcode = next( hustle_unsubscribe_data.shortcode_tag, text );

					if ( 'undefined' === typeof found_shortcode ) {
						return false;
					}

					return true;
				},
				transform( { text } ) {

					let { shortcode } = next( hustle_unsubscribe_data.shortcode_tag, text ),
					{ attrs: { named: { id, skip_confirmation } } } = shortcode;

					id = id ? id.replace(/\s/g,'').split(',') : '';
					const skipConfirmation = 'true' === skip_confirmation;

					return createBlock( 'hustle/unsubscribe', { id, skipConfirmation } );
				},
			},
		]
	},
	edit: Hustle_Unsubscribe_BlockEdit,

	// This is rendered server-side.
	save() {
		return null;
	},

} );