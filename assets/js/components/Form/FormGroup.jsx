import classNames from "classnames"

export const FormGroup = ({attributes, children}) => {
    let fieldClasses = classNames(
        'form-group',
        `form-group--${attributes.type}`,
        `field`,
        `field--${attributes.type}`,
        `field--${attributes.basename}`
        , {
        'field--required': attributes.attributes.required
    })

    return (<div className={fieldClasses}>{children}</div>)
}
