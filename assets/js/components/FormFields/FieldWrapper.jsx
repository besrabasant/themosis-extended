import {Label} from "./Label";
import FieldInfo from "../Form/FieldInfo";
import FieldErrors from "../Form/FieldErrors";
import {FormGroup} from "../Form/FormGroup";

export const FieldWrapper = ({attributes, infoPosition, errorPosition, children}) => {
    return (
        <FormGroup attributes={attributes}>
            <Label labelAttributes={attributes.label}/>
            {(infoPosition === 'top') ? (<FieldInfo info={attributes.options.info}/>) : null}
            {(errorPosition === 'top') ? (<FieldErrors validation={attributes.validation}/>) : null}
            {children}
            {(infoPosition === 'bottom') ? (<FieldInfo info={attributes.options.info}/>) : null}
            {(errorPosition === 'bottom') ? (<FieldErrors validation={attributes.validation}/>) : null}
        </FormGroup>
    )
}

FieldWrapper.defaultProps = {
    infoPosition: 'bottom',
    errorPosition: 'bottom'
}