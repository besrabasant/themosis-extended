export const FieldGroup = ({fieldGroup, children}) => {
    return (<div className={`admin-page__field-group admin-page__field-group--${fieldGroup.id}`}>{children}</div>)
}