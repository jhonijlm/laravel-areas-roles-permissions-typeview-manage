let d = document;


let listAreas;
let listPermissions;
let listTypeViews;
let rolDetail;
const elmtSelectArea = d.getElementById("selectArea");


const getAreasDetail = async() => {
    const response = await fetch("/api/areas/list-select");
    listAreas = await response.json();
}


const getPermissions = async() => {
    const response = await fetch("/api/permissions/list");
    listPermissions = await response.json();
}


const getTypeViews = async() => {
    const response = await fetch("/api/type-view/list-select");
    listTypeViews = await response.json();
}

const getRolDetail = async() => {
    // if(d.getElementById('id')){
    //     const response = await fetch("/api/roles/get/" + d.getElementById('id').value);
    //     rolDetail = await response.json();
    // }
    if(d.getElementById('role')){
        rolDetail = JSON.parse(d.getElementById('role').value);
    }
}

const buildAreasDetail = async(event = null) => {

    const listElmtOptions = Array.from(event ? event.target.childNodes : d.getElementById("selectArea").childNodes).filter(elmt => elmt.nodeName == "OPTION" && elmt.selected == true);

    const elmtDivContent = d.getElementById("content");
    elmtDivContent.innerHTML = "";
    d.getElementById("updatedAreas").value =  JSON.stringify(getModules());
    for(let area of listAreas){
        for(let elmt of listElmtOptions){
            if(elmt.value == area.id){

                const elmtLabel = d.createElement("label");
                elmtLabel.innerText = area.name;
                const elmtInputHiddenArea = d.createElement("input");
                elmtInputHiddenArea.type = "hidden";
                elmtInputHiddenArea.value = area.id;

                const elmtTable = d.createElement("table");
                elmtTable.className = "table table-bordered";
                const elmtHead = d.createElement("thead");
                const elmtTbody = d.createElement("tbody");
                const elmtTheadTr1 = d.createElement("tr");
                const elmtTheadTr2 = d.createElement("tr");

                // HEAD
                const elmtth1 = d.createElement("th");
                elmtth1.innerText = "Check";
                elmtth1.rowSpan = 2;
                const elmtth2 = d.createElement("th");
                elmtth2.innerText = "Module";
                elmtth2.rowSpan = 2;
                const elmtth3 = d.createElement("th");
                elmtth3.innerText = "Access";
                elmtth3.rowSpan = 2;
                const elmtth4 = d.createElement("th");
                elmtth4.innerText = "Permissions";
                elmtth4.colSpan = 6;
                const elmtth5 = d.createElement("th");
                elmtth5.innerText = "Check All";
                elmtth5.rowSpan = 2;

                elmtTheadTr1.appendChild(elmtth1);
                elmtTheadTr1.appendChild(elmtth2);
                elmtTheadTr1.appendChild(elmtth3);
                elmtTheadTr1.appendChild(elmtth4);
                elmtTheadTr1.appendChild(elmtth5);

                for(let permission of listPermissions){
                    const elmtThPermission = d.createElement("th");
                    elmtThPermission.innerText = permission.name;
                    elmtTheadTr2.appendChild(elmtThPermission)
                }

                elmtHead.appendChild(elmtTheadTr1);
                elmtHead.appendChild(elmtTheadTr2);

                elmtDivContent.appendChild(elmtLabel);
                elmtDivContent.appendChild(elmtInputHiddenArea);
                elmtTable.appendChild(elmtHead);

                // BODY
                for(let module of area.modules){

                    const elmtTrBody = d.createElement("tr");

                    const elmtTd1 = d.createElement("td");
                    const elmtTd2 = d.createElement("td");
                    const elmtTd3 = d.createElement("td");

                    const elmtTd5 = d.createElement("td");


                    const elmtInputHiddenModule = d.createElement("input");
                    elmtInputHiddenModule.type = "hidden";
                    elmtInputHiddenModule.name = "module[]";
                    elmtInputHiddenModule.value = module.id;

                    const elmtCheckModule = d.createElement("input");
                    elmtCheckModule.type = "checkbox";
                    elmtCheckModule.checked = rolDetail ? (rolDetail.areas.filter(areaDt => areaDt.id == area.id && areaDt.modules.filter(moduleDt => moduleDt.id == module.id).length > 0).length > 0 ? true : false) : false;
                    elmtCheckModule.onclick = () => {
                        d.getElementById("updatedAreas").value =  JSON.stringify(getModules());
                    }

                    elmtTd1.appendChild(elmtCheckModule);
                    elmtTd1.appendChild(elmtInputHiddenModule);

                    elmtTd2.innerText = module.name;

                    // TYPE VIEW
                    const elmtSelectTypeView = d.createElement("select");
                    elmtSelectTypeView.onchange = () => {
                        d.getElementById("updatedAreas").value =  JSON.stringify(getModules());
                    }
                    elmtSelectTypeView.className = "form-select";
                    for(let typeView of listTypeViews){
                        const elmtOption = d.createElement("option");
                        elmtOption.innerText = typeView.name;
                        elmtOption.value = typeView.id;
                        elmtOption.selected = rolDetail ? (rolDetail.areas.filter(areaDt => areaDt.id == area.id && areaDt.modules.filter(moduleDt => moduleDt.id == module.id && moduleDt.typeView.id == typeView.id).length > 0).length > 0 ? true : false) : false;
                        elmtSelectTypeView.appendChild(elmtOption);
                    }

                    elmtTd3.appendChild(elmtSelectTypeView);

                    elmtTrBody.appendChild(elmtTd1);
                    elmtTrBody.appendChild(elmtTd2);
                    elmtTrBody.appendChild(elmtTd3);

                    // PERMISSIONS
                    for(let permission of listPermissions){

                        const elmtTd4 = d.createElement("td"); // PERMISSION
                        if(module.permissions.filter(permissionDt => permissionDt.id == permission.id).length > 0){

                            const elmtInputHiddenPermission = d.createElement("input");
                            elmtInputHiddenPermission.className = "form-check-lg";
                            elmtInputHiddenPermission.type = "hidden";
                            elmtInputHiddenPermission.value = permission.id;
                            const elmtCheckPermission = d.createElement("input");
                            elmtCheckPermission.type = "checkbox";
                            elmtCheckPermission.checked = rolDetail ? (rolDetail.areas.filter(areaDt => areaDt.id == area.id && areaDt.modules.filter(moduleDt => moduleDt.id == module.id && moduleDt.permissions.filter(permissionDt => permissionDt.id == permission.id).length > 0).length > 0).length > 0 ? true : false) : false;
                            elmtCheckPermission.onclick = () => {
                                d.getElementById("updatedAreas").value =  JSON.stringify(getModules());
                            };

                            elmtTd4.appendChild(elmtCheckPermission);
                            elmtTd4.appendChild(elmtInputHiddenPermission);
                        }


                        elmtTrBody.appendChild(elmtTd4);
                    }

                    const elmtInputCheck = d.createElement("input");
                    elmtInputCheck.type = "checkbox";
                    elmtInputCheck.onclick = () => {
                        const listElmtCheckbox = Array.from(elmtInputCheck.parentNode.parentNode.childNodes).filter(elmt => Array.from(elmt.childNodes).filter(elmt2 => elmt2.nodeName == "INPUT" && elmt2.type == "checkbox").length > 0 );
                        for(let elmtCheckbox of listElmtCheckbox){
                            elmtCheckbox.firstChild.checked = elmtInputCheck.checked;
                        }
                        d.getElementById("updatedAreas").value =  JSON.stringify(getModules());
                    };
                    elmtTd5.appendChild(elmtInputCheck);

                    elmtTrBody.appendChild(elmtTd5);


                    elmtTbody.appendChild(elmtTrBody);
                    elmtTable.appendChild(elmtTbody);
                }




                elmtDivContent.appendChild(elmtTable);
                elmtDivContent.appendChild(d.createElement("br"));
            }
        }
    }
}


const getModules = () => {
    const listElmtModule = document.getElementById("content").childNodes;

    let listAreasData = new Array();

    let countTable = 0;
    for(let elmt of listElmtModule){
        if(elmt.nodeName == "TABLE"){
            let listModules = new Array();
            for(let elmt2 of elmt.lastChild.childNodes){
                if(elmt2.firstChild.firstChild.checked){
                    const elmtTd = Array.from(elmt2.childNodes).filter(elmtx => elmtx.nodeName == "TD");
                    let moduleId = elmtTd[0].lastChild.value;
                    let typeViewId = elmtTd[2].firstChild.value;

                    let permissionIndex = null;

                    let permissionList = null;
                    let permissionGet = null;
                    let permissionCreate = null;

                    let permissionUpdate = null;
                    let permissionDelete = null;


                    if(elmtTd[3].firstChild && elmtTd[3].firstChild.checked){
                        permissionIndex = elmtTd[3].lastChild.value;
                    }

                    if(elmtTd[4].firstChild && elmtTd[4].firstChild.checked){
                        permissionList = elmtTd[4].lastChild.value;
                    }

                    if(elmtTd[5].firstChild && elmtTd[5].firstChild.checked){
                        permissionGet = elmtTd[5].lastChild.value;
                    }

                    if(elmtTd[6].firstChild && elmtTd[6].firstChild.checked){
                        permissionCreate = elmtTd[6].lastChild.value;
                    }

                    if(elmtTd[7].firstChild && elmtTd[7].firstChild.checked){
                        permissionUpdate = elmtTd[7].lastChild.value;
                    }

                    if(elmtTd[8].firstChild && elmtTd[8].firstChild.checked){
                        permissionDelete = elmtTd[8].lastChild.value;
                    }
                    listModules.push(
                        {
                            moduleId: moduleId,
                            typeViewId: typeViewId,
                            permissionsId: [permissionIndex, permissionList, permissionGet, permissionCreate, permissionUpdate, permissionDelete].filter(perm => perm != null)
                        }
                    );
                }

            }
            listAreasData.push({
                areaId: Array.from(elmt.parentNode.childNodes).filter(elmtx => elmtx.nodeName == "INPUT")[countTable].value,
                modulesId: listModules
            });

            countTable++;
        }
    }

    return listAreasData;
}



(async () => {
    getRolDetail();
    await getAreasDetail();
    await getPermissions();
    await getTypeViews();
    await buildAreasDetail();

})().catch(err => {
    console.error(err);
});


elmtSelectArea.addEventListener("change", buildAreasDetail);



