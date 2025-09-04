/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	MediaUpload,
	MediaUploadCheck,
	InspectorControls,
	RichText,
	URLInput,
} from '@wordpress/block-editor';
import {
	PanelBody,
	Button,
	TextControl,
	RangeControl,
	ColorPicker,
	SelectControl,
	ToggleControl,
} from '@wordpress/components';
import { Fragment } from '@wordpress/element';

/**
 * Edit component for the Fundi Hero block
 *
 * @param {Object} props - Block props
 * @return {JSX.Element} Edit component
 */
export default function Edit( { attributes, setAttributes } ) {
	const {
		backgroundImage,
		backgroundImageUrl,
		title,
		subtitle,
		buttonText,
		buttonUrl,
		buttonTarget,
		overlayOpacity,
		textColor,
		contentAlignment,
	} = attributes;

	const blockProps = useBlockProps( {
		className: 'wp-block-wp-fundi-fundi-hero',
		style: {
			backgroundImage: backgroundImageUrl
				? `url(${ backgroundImageUrl })`
				: undefined,
			color: textColor,
			textAlign: contentAlignment,
		},
	} );

	const onSelectImage = ( media ) => {
		setAttributes( {
			backgroundImage: media,
			backgroundImageUrl: media.url,
		} );
	};

	const onRemoveImage = () => {
		setAttributes( {
			backgroundImage: null,
			backgroundImageUrl: '',
		} );
	};

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody title={ __( 'Background Settings', 'wp-fundi' ) }>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ onSelectImage }
							allowedTypes={ [ 'image' ] }
							value={ backgroundImage?.id }
							render={ ( { open } ) => (
								<Button
									onClick={ open }
									variant="secondary"
									isPrimary={ ! backgroundImage }
								>
									{ backgroundImage
										? __( 'Change Background Image', 'wp-fundi' )
										: __( 'Select Background Image', 'wp-fundi' )
									}
								</Button>
							) }
						/>
						{ backgroundImage && (
							<Button
								onClick={ onRemoveImage }
								variant="link"
								isDestructive
							>
								{ __( 'Remove Background Image', 'wp-fundi' ) }
							</Button>
						) }
					</MediaUploadCheck>

					<RangeControl
						label={ __( 'Overlay Opacity', 'wp-fundi' ) }
						value={ overlayOpacity }
						onChange={ ( value ) =>
							setAttributes( { overlayOpacity: value } )
						}
						min={ 0 }
						max={ 1 }
						step={ 0.1 }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Content Settings', 'wp-fundi' ) }>
					<SelectControl
						label={ __( 'Content Alignment', 'wp-fundi' ) }
						value={ contentAlignment }
						options={ [
							{ label: __( 'Left', 'wp-fundi' ), value: 'left' },
							{ label: __( 'Center', 'wp-fundi' ), value: 'center' },
							{ label: __( 'Right', 'wp-fundi' ), value: 'right' },
						] }
						onChange={ ( value ) =>
							setAttributes( { contentAlignment: value } )
						}
					/>

					<ColorPicker
						color={ textColor }
						onChange={ ( value ) =>
							setAttributes( { textColor: value } )
						}
						disableAlpha
					/>
				</PanelBody>

				<PanelBody title={ __( 'Button Settings', 'wp-fundi' ) }>
					<TextControl
						label={ __( 'Button URL', 'wp-fundi' ) }
						value={ buttonUrl }
						onChange={ ( value ) =>
							setAttributes( { buttonUrl: value } )
						}
						placeholder={ __( 'Enter button URL', 'wp-fundi' ) }
					/>

					<ToggleControl
						label={ __( 'Open in new tab', 'wp-fundi' ) }
						checked={ buttonTarget }
						onChange={ ( value ) =>
							setAttributes( { buttonTarget: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<div
					className="fundi-hero-overlay"
					style={ {
						opacity: overlayOpacity,
					} }
				/>
				<div className="fundi-hero-content">
					<RichText
						tagName="h1"
						className="fundi-hero-title"
						value={ title }
						onChange={ ( value ) =>
							setAttributes( { title: value } )
						}
						placeholder={ __( 'Enter hero title', 'wp-fundi' ) }
						allowedFormats={ [ 'core/bold', 'core/italic' ] }
					/>

					<RichText
						tagName="p"
						className="fundi-hero-subtitle"
						value={ subtitle }
						onChange={ ( value ) =>
							setAttributes( { subtitle: value } )
						}
						placeholder={ __( 'Enter hero subtitle', 'wp-fundi' ) }
						allowedFormats={ [ 'core/bold', 'core/italic' ] }
					/>

					{ buttonText && (
						<div className="fundi-hero-button-wrapper">
							<RichText
								tagName="span"
								className="fundi-hero-button"
								value={ buttonText }
								onChange={ ( value ) =>
									setAttributes( { buttonText: value } )
								}
								placeholder={ __( 'Enter button text', 'wp-fundi' ) }
								allowedFormats={ [] }
							/>
						</div>
					) }

					{ ! backgroundImageUrl && (
						<div className="fundi-hero-placeholder">
							<p>{ __( 'Select a background image to get started', 'wp-fundi' ) }</p>
						</div>
					) }
				</div>
			</div>
		</Fragment>
	);
}
