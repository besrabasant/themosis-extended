import {Label} from "./Label";
import FieldInfo from "../Form/FieldInfo";
import FieldErrors from "../Form/FieldErrors";
import {FormGroup} from "../Form/FormGroup";

export const FieldWrapper = ({attributes, children}) => {
    return (
        <FormGroup type={attributes.type}>
            <Label labelAttributes={attributes.label}/>
            {children}
            <FieldInfo info={attributes.options.info}/>
            <FieldErrors validation={attributes.validation}/>
        </FormGroup>
    )
}