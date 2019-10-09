import {FieldWrapper} from "./FieldWrapper";
import {useState} from '@wordpress/element'
import {SyntheticEvent} from 'react'

export const IntegerField = ({attributes}) => {

    let [value, setValue] = useState((attributes.value || attributes.attributes.value))
    let {class: classAttr, ...fieldAttributes} = attributes.attributes

    /**
     * @param {SyntheticEvent} event
     */
    function onChange(event) {
        setValue(event.target.value)
    }

    return (
        <FieldWrapper attributes={attributes}>
            <input type="number" className="form-control" name={attributes.name} 
                   onChange={onChange}
                   value={value}
                   autoComplete="off"
                   {...fieldAttributes}/>
        </FieldWrapper>
    )
}

