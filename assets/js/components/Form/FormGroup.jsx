export const FormGroup = ({attributes, children}) => {
    let fieldRequiredClass = (attributes.attributes.required) ? ' field--required' : '';

    return (<div className={`form-group form-group--${attributes.type} field field--${attributes.type}${fieldRequiredClass}`}>{children}</div>)
}
