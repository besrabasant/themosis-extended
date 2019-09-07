import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {FormGroup} from "../Form/FormGroup";
import {SidebarCtaFill} from "../../core/slotfills";
import {useRef} from '@wordpress/element'


const FormSubmitComponent = ({attributes, delegatedClickHandler}) => {
    return (
        <FormGroup attributes={attributes}>
            <input type="submit" className="components-button is-button is-primary is-large" name={attributes.name}
                   id={attributes.attributes.id} value={attributes.label.inner} onClick={delegatedClickHandler}/>
        </FormGroup>
    )
}


FormSubmitComponent.defaultProps = {
    delegatedClickHandler: () => {
    }
}

const DelegatedFormSubmitComponent = ({attributes}) => {
    const submitEl = useRef(null);

    const delegatedClickHandler = () => {
        submitEl.current.click()
    }

    return (
        <>
            <input type="submit" ref={submitEl} style={{display: 'none'}} name={attributes.name}
                   id={attributes.attributes.id}/>
            <SidebarCtaFill>
                <FormSubmitComponent attributes={attributes} delegatedClickHandler={delegatedClickHandler}/>
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

registerComponent('themosis.fields.submit', {
    renderProp: FormSubmit
})