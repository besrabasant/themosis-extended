/** @global dd */

import {Component} from 'react'
import {useState} from '@wordpress/element'
import {FieldWrapper} from '../FieldWrapper'
import {Loading} from '../../Loading'
import {renderFields} from "../../AdminForm";
import {useFetchVirtualResource} from "./useFetchVirtualResource";
import {prepareFilterFields} from "./prepareFilterFields";
import {find} from 'lodash'


const renderSelectOptions = (items, selections, handleSelection) => {

    return (
        <>
            <div className="virtual-list">
                {(items.length) ?
                    selections.map((selectionID) => {
                        let item = find(items, {id: parseInt(selectionID)})

                        function handleItemClick(e) {
                            handleSelection(e.target)
                        }

                        return (item !== undefined) ? (
                            <div key={`virtual-list-${item.id}`} className="virtual-list__item">
                                <div className="virtual-list__item-checkbox">
                                    <input onChange={handleItemClick} value={item.id}
                                           checked={selections.includes(String(item.id))} type="checkbox"/>
                                </div>
                                <div className="virtual-list__item-content"
                                     dangerouslySetInnerHTML={{__html: item.content}}/>
                            </div>
                        ) : null
                    }) : null
                }
                {
                    items
                        .filter((item) => (!selections.includes(String(item.id))))
                        .map((item, index) => {

                            function handleItemClick(e) {
                                handleSelection(e.target)
                            }

                            return (
                                <div key={`virtual-list-${item.id}`} className="virtual-list__item">
                                    <div className="virtual-list__item-checkbox">
                                        <input onChange={handleItemClick} value={item.id}
                                               checked={selections.includes(String(item.id))} type="checkbox"/>
                                    </div>
                                    <div className="virtual-list__item-content"
                                         dangerouslySetInnerHTML={{__html: item.content}}/>
                                </div>
                            )
                        })
                }
            </div>
        </>
    )
}

const renderShadowComponent = (attributes, selections) => {
    return (
        <div className='field__shadow-component'>
            {selections.map(selection => (
                <input key={`virtual-multi-select-${selection}`} type='hidden' name={`${attributes.name}[]`}
                       value={selection}/>))}
        </div>
    )
}


/**
 * Virtual MultiSelect Component.
 *
 * @param attributes
 *
 * @returns {Component}
 * @constructor
 */
export const VirtualMultiSelect = ({attributes}) => {

    // dd(attributes)

    let [selections, setSelections] = useState(attributes.value || attributes.default)
    let [items, filters, updateSearchFilters, loading] = useFetchVirtualResource(attributes)

    function addItem(item) {
        setSelections([...selections, item])
    }

    function removeItem(item) {
        setSelections(state => state.filter(stateitem => stateitem !== item))
    }

    function handleSelection(selection) {
        if (selections.includes(selection.value)) {
            removeItem(selection.value)
        } else {
            addItem(selection.value)
        }
    }

    return (
        <FieldWrapper attributes={attributes} infoPosition="top" errorPosition="top">
            <div className="field__header field__header--virtual-list">
                <div className="field__filters">
                    {renderFields(prepareFilterFields(attributes.options.filters, filters, updateSearchFilters))}
                </div>
                <div className='field__stats'>
                    <span className="selections-count">{selections.length}</span> Selections
                </div>
            </div>

            <div className='field__body field__body--virtual-list'>
                {loading && (<Loading/>)}
                {renderSelectOptions(items, selections, handleSelection)}
                {renderShadowComponent(attributes, selections)}
            </div>
        </FieldWrapper>
    )
}