/**
 * WordPress dependencies
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

/**
 * Save component for the Fundi Hero block
 *
 * @param {Object} props - Block props
 * @return {JSX.Element} Save component
 */
export default function Save( { attributes } ) {
	const {
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

	const blockProps = useBlockProps.save( {
		className: 'wp-block-wp-fundi-fundi-hero',
		style: {
			backgroundImage: backgroundImageUrl
				? `url(${ backgroundImageUrl })`
				: undefined,
			color: textColor,
			textAlign: contentAlignment,
		},
	} );

	return (
		<div { ...blockProps }>
			<div
				className="fundi-hero-overlay"
				style={ {
					opacity: overlayOpacity,
				} }
			/>
			<div className="fundi-hero-content">
				{ title && (
					<RichText.Content
						tagName="h1"
						className="fundi-hero-title"
						value={ title }
					/>
				) }

				{ subtitle && (
					<RichText.Content
						tagName="p"
						className="fundi-hero-subtitle"
						value={ subtitle }
					/>
				) }

				{ buttonText && buttonUrl && (
					<div className="fundi-hero-button-wrapper">
						<a
							href={ buttonUrl }
							className="fundi-hero-button"
							target={ buttonTarget ? '_blank' : undefined }
							rel={ buttonTarget ? 'noopener noreferrer' : undefined }
						>
							<RichText.Content value={ buttonText } />
						</a>
					</div>
				) }
			</div>
		</div>
	);
}
