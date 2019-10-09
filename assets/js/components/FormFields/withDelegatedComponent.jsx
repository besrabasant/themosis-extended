import {SidebarFieldsFill} from "../../core/slotfills";
import {useState} from "@wordpress/element";

export const withDelegatedComponent = ({attributes}) => {
    return (BaseComponent) => {

        const DelegatedComponent = () => {
            let [value, setValue] = useState((attributes.value || attributes.default))

            function delegatedCallback(value) {
                setValue(value)
            }

            return (
                <>
                    <input type="hidden" name={attributes.name} id={attributes.attributes.id} defaultValue={value}/>
                    <SidebarFieldsFill>
                        <BaseComponent attributes={attributes} delegatedCallback={delegatedCallback}/>
                    </SidebarFieldsFill>
                </>)

        }

        DelegatedComponent.displayName = `Delegated${BaseComponent.displayName}`

        return (<DelegatedComponent/>)
    }
}