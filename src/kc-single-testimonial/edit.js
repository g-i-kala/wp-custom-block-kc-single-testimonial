import { __ } from "@wordpress/i18n";
import { useSelect } from "@wordpress/data";
import ServerSideRender from "@wordpress/server-side-render";
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import {
	PanelBody,
	Placeholder,
	SelectControl,
	Spinner,
} from "@wordpress/components";

export default function Edit({ attributes, setAttributes }) {
	const { testimonialId } = attributes;

	const testimonials = useSelect((select) => {
		return (
			select("core").getEntityRecords("postType", "testimonial", {
				per_page: -1,
				orderby: "title",
				order: "asc",
				_fields: ["id", "title"],
			}) || []
		);
	}, []);

	const options = [
		{ label: __("Select a testimonial", "kc-single-testimonial"), value: 0 },
		...(testimonials || []).map((item) => ({
			label: item.title?.rendered || `#${item.id}`,
			value: item.id,
		})),
	];

	const blockProps = useBlockProps({
		className: "kc-single-testimonial kc-single-testimonial--editor",
	});

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={__("Testimonial", "kc-single-testimonial")}
					initialOpen={true}
				>
					{!testimonials ? (
						<Spinner />
					) : (
						<SelectControl
							label={__("Choose testimonial", "kc-single-testimonial")}
							value={testimonialId}
							options={options}
							onChange={(value) =>
								setAttributes({
									testimonialId: parseInt(value, 10) || 0,
								})
							}
						/>
					)}
				</PanelBody>
			</InspectorControls>

			<div {...blockProps}>
				{testimonialId ? (
					<ServerSideRender
						block="create-block/kc-single-testimonial"
						attributes={{ testimonialId }}
					/>
				) : (
					<Placeholder
						label={__("KC Single Testimonial", "kc-single-testimonial")}
						instructions={__(
							"Select a testimonial in the sidebar.",
							"kc-single-testimonial",
						)}
					/>
				)}
			</div>
		</>
	);
}
