export const Label = ({labelAttributes}) => {
    return labelAttributes && (
        <label className="field__label" htmlFor={labelAttributes.attributes.for}>
            {labelAttributes.inner}
        </label>
    )
}