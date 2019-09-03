export const Label = ({labelAttributes}) => {
    return (<label className="field__label" htmlFor={labelAttributes.attributes.for}>{labelAttributes.inner}</label>)
}