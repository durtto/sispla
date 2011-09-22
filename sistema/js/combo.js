// name: GetCombo
// @param
// @return
function GetCombo(nombre,etiqueta){
 co_nombre=nombre;
 nb_nombre='nb_'+nombre.substring(3);
 accion=nombre.substring(3);
 var combo = new Ext.form.ComboBox({
  name: nombre,
  id: nombre,
  emptyText: 'Seleccione..',
  //hiddenName: nombre+"hide",
  //forceSelection: true,
  valueField:nombre,
  fieldLabel:etiqueta,
  displayField:nb_nombre,
  editable: false,
  anchor: '80%',
  listWidth:220,
  typeAhead:true,
  mode: 'remote',
  triggerAction:'all',
  store: new Ext.data.JsonStore({
   url: '../clases/Combos.php',
   root: 'Resultados',
   idProperty: co_nombre,
   baseParams: {
    accion: accion
   },
   fields: [co_nombre, nb_nombre]
  })
 });
 return combo;
}