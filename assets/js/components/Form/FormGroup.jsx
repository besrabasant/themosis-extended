export const FormGroup = ({type, children}) => {
    return (<div className={`form-group form-group--${type}`}>{children}</div>)
}
