export const FieldGroup = ({fieldGroup, children}) => {
    return (fieldGroup.id == 'form-page') ?
        (<>{children}</>)
        :
        (<div className={`admin-page__field-group admin-page__field-group--${fieldGroup.id}`}>{children}</div>)
}