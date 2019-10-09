import {FormGroup} from "../Form/FormGroup";
import {SidebarCtaFill} from "../../core/slotfills";
import {useRef} from '@wordpress/element'


const FormSubmitComponent = ({attributes, delegatedCallback}) => {
    let {class: classAttr, ...fieldAttributes} = attributes.attributes
    return (
        <FormGroup attributes={attributes}>
            <input type="submit" className="components-button is-button is-primary is-large" name={attributes.name}
                   value={attributes.label.inner} onClick={delegatedCallback}
                   {...fieldAttributes}/>
        </FormGroup>
    )
}


FormSubmitComponent.defaultProps = {
    delegatedCallback: () => {
    }
}

const DelegatedFormSubmitComponent = ({attributes}) => {
    const submitEl = useRef(null);

    const delegatedCallback = () => {
        submitEl.current.click()
    }

    return (
        <>
            <input type="submit" ref={submitEl} style={{display: 'none'}} name={attributes.name}
                   id={attributes.attributes.id}/>
            <SidebarCtaFill>
                <FormSubmitComponent attributes={attributes} delegatedCallback={delegatedCallback}/>
            </SidebarCtaFill>
        </>
    )

}

export const FormSubmit = ({attributes}) => {
    return (attributes.options.group == 'sidebar-cta') ?
        (<DelegatedFormSubmitComponent attributes={attributes}/>)
        :
        (<FormSubmitComponent attributes={attributes}/>)
}
