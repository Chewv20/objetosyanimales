const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    $(document).ready(function(){
        iniciaEstadisticas()
        document.getElementById('filtro').addEventListener('click',(e)=>{
            actualizaEstadisticas()
        })
       
        creaMapa()


    })
    
function iniciaEstadisticas(){
        fetch('/estadisticas/getall/',{
        method : 'POST',
        body: JSON.stringify({   
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        document.getElementById('numObjetos').innerHTML= data[0]
        document.getElementById('numAnimales').innerHTML= data[1]
        document.getElementById('numAccidentados').innerHTML= data[2]
        document.getElementById('numPersonasAjenas').innerHTML= data[3]
        document.getElementById('numIncidentes').innerHTML= data[4]
        document.getElementById('numPuertas').innerHTML= data[5]
        document.getElementById('numZapatas').innerHTML= data[6]
        document.getElementById('total').innerHTML= data[7]
        

    }).catch(error => console.error(error));
}

function actualizaEstadisticas(Pdata){
    fetch('/estadisticas/getcuentas/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  document.getElementById('fecha').value,
            fecha2 : document.getElementById('fecha2').value,     
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        document.getElementById('numObjetos').innerHTML= data[0]
        document.getElementById('numAnimales').innerHTML= data[1]
        document.getElementById('numAccidentados').innerHTML= data[2]
        document.getElementById('numPersonasAjenas').innerHTML= data[3]
        document.getElementById('numIncidentes').innerHTML= data[4]
        document.getElementById('numPuertas').innerHTML= data[5]
        document.getElementById('numZapatas').innerHTML= data[6]
        document.getElementById('total').innerHTML= data[7]

        

    }).catch(error => console.error(error));
    
    setTimeout(actualizaEstadisticas,5000)
}

function creaMapa(){
    var LeafIcon = L.Icon.extend({
        options: {
            iconSize:     [15, 15],
            iconAnchor:   [0, 0],
            popupAnchor:  [8, 10]
        }
    })

    var icon1 = new LeafIcon({iconUrl: '../img/1_circle.png'})
    var icon2 = new LeafIcon({iconUrl: '../img/2_circle.png'})
    var icon3 = new LeafIcon({iconUrl: '../img/3_circle.png'})
    var icon4 = new LeafIcon({iconUrl: '../img/4_circle.png'})
    var icon5 = new LeafIcon({iconUrl: '../img/5_circle.png'})
    var icon6 = new LeafIcon({iconUrl: '../img/6_circle.png'})
    var icon7 = new LeafIcon({iconUrl: '../img/7_circle.png'})
    var icon8 = new LeafIcon({iconUrl: '../img/8_circle.png'})
    var icon9 = new LeafIcon({iconUrl: '../img/9_circle.png'})
  var icon12 = new LeafIcon({iconUrl: '../img/12_circle.png'})
    var icona = new LeafIcon({iconUrl: '../img/a_circle.png'})
    var iconb = new LeafIcon({iconUrl: '../img/b_circle.png'})
    
    /* Línea 1 */
    var linea1_1  =  L.marker([19.398188, -99.201085],{icon:icon1},{draggable: true})
    var linea1_2  =  L.marker([19.402140, -99.187516],{icon:icon1},{draggable: true})
    var linea1_3  =  L.marker([19.413200, -99.182434],{icon:icon1},{draggable: true})
    var linea1_4  =  L.marker([19.420649, -99.177261],{icon:icon1},{draggable: true})
    var linea1_5  =  L.marker([19.422340, -99.171098],{icon:icon1},{draggable: true})
    var linea1_6  =  L.marker([19.423852, -99.163327],{icon:icon1},{draggable: true})
    var linea1_7  =  L.marker([19.425902, -99.154638],{icon:icon1},{draggable: true})
    var linea1_8  =  L.marker([19.427269, -99.148949],{icon:icon1},{draggable: true})
    var linea1_9  =  L.marker([19.427803, -99.142507],{icon:icon1},{draggable: true})
    var linea1_10 =  L.marker([19.426117, -99.137889],{icon:icon1},{draggable: true})
    var linea1_11 =  L.marker([19.424941, -99.132948],{icon:icon1},{draggable: true})
    var linea1_12 =  L.marker([19.425764, -99.125038],{icon:icon1},{draggable: true})
    var linea1_13 =  L.marker([19.429618, -99.119913],{icon:icon1},{draggable: true})
    var linea1_14 =  L.marker([19.431284, -99.114164],{icon:icon1},{draggable: true})
    var linea1_15 =  L.marker([19.427303, -99.109591],{icon:icon1},{draggable: true})
    var linea1_16 =  L.marker([19.423305, -99.102585],{icon:icon1},{draggable: true})
    var linea1_17 =  L.marker([19.419697, -99.096399],{icon:icon1},{draggable: true})
    var linea1_18 =  L.marker([19.416422, -99.090581],{icon:icon1},{draggable: true})
    var linea1_19 =  L.marker([19.412260, -99.082598],{icon:icon1},{draggable: true})
    var linea1_20 =  L.marker([19.416337, -99.074342],{icon:icon1},{draggable: true})
    let prueba = '<b>Observatorio</b><br>'
    prueba += 'Zapatas: 10'
    linea1_1.bindPopup(prueba)
    
    /* Línea 2 */
    var linea2_1  =  L.marker([19.460584, -99.215713],{icon:icon2},{draggable: true}).bindPopup('Cuatro caminos')
    var linea2_2  =  L.marker([19.458686, -99.203064],{icon:icon2},{draggable: true}).bindPopup('Panteones')
    var linea2_3  =  L.marker([19.458424, -99.188504],{icon:icon2},{draggable: true}).bindPopup('Tacuba')
    var linea2_4  =  L.marker([19.457243, -99.181471],{icon:icon2},{draggable: true}).bindPopup('Cuitláhuac')
    var linea2_5  =  L.marker([19.452930, -99.175474],{icon:icon2},{draggable: true}).bindPopup('Popotla')
    var linea2_6  =  L.marker([19.449250, -99.171863],{icon:icon2},{draggable: true}).bindPopup('Colegio militar')
    var linea2_7  =  L.marker([19.444753, -99.167355],{icon:icon2},{draggable: true}).bindPopup('Normal')
    var linea2_8  =  L.marker([19.442093, -99.160735],{icon:icon2},{draggable: true}).bindPopup('San cosme')
    var linea2_9  =  L.marker([19.439058, -99.154288],{icon:icon2},{draggable: true}).bindPopup('Revolución')
    var linea2_10 =  L.marker([19.437280, -99.147065],{icon:icon2},{draggable: true}).bindPopup('Hidalgo')
    var linea2_11 =  L.marker([19.436974, -99.141021],{icon:icon2},{draggable: true}).bindPopup('Bellas artes')
    var linea2_12 =  L.marker([19.435547, -99.137066],{icon:icon2},{draggable: true}).bindPopup('Allende')
    var linea2_13 =  L.marker([19.432568, -99.132316],{icon:icon2},{draggable: true}).bindPopup('Zócalo')
    var linea2_14 =  L.marker([19.424885, -99.132948],{icon:icon2},{draggable: true}).bindPopup('Pino Suárez')
    var linea2_15 =  L.marker([19.415793, -99.134595],{icon:icon2},{draggable: true}).bindPopup('San antonio abad')
    var linea2_16 =  L.marker([19.409216, -99.135609],{icon:icon2},{draggable: true}).bindPopup('Chabacano')
    var linea2_17 =  L.marker([19.401017, -99.136888],{icon:icon2},{draggable: true}).bindPopup('Viaducto')
    var linea2_18 =  L.marker([19.395265, -99.137813],{icon:icon2},{draggable: true}).bindPopup('Xola')
    var linea2_19 =  L.marker([19.387645, -99.138965],{icon:icon2},{draggable: true}).bindPopup('Villa de cortés')
    var linea2_20 =  L.marker([19.379519, -99.140210],{icon:icon2},{draggable: true}).bindPopup('Nativitas')
    var linea2_21 =  L.marker([19.369856, -99.141595],{icon:icon2},{draggable: true}).bindPopup('Portales')
    var linea2_22 =  L.marker([19.361896, -99.142920],{icon:icon2},{draggable: true}).bindPopup('Ermita')
    var linea2_23 =  L.marker([19.354873, -99.144782],{icon:icon2},{draggable: true}).bindPopup('General anaya')
    var linea2_24 =  L.marker([19.343756, -99.139592],{icon:icon2},{draggable: true}).bindPopup('Tasqueña')
    
    /* Línea 3 */
    var linea3_1  =  L.marker([19.495086, -99.119617],{icon:icon3},{draggable: true}).bindPopup('Indios verdes')
    var linea3_2  =  L.marker([19.485169, -99.125489],{icon:icon3},{draggable: true}).bindPopup('Deportivo 18 de marzo')
    var linea3_3  =  L.marker([19.477107, -99.132089],{icon:icon3},{draggable: true}).bindPopup('Potrero')
    var linea3_4  =  L.marker([19.469644, -99.136521],{icon:icon3},{draggable: true}).bindPopup('La raza')
    var linea3_5  =  L.marker([19.455045, -99.143167],{icon:icon3},{draggable: true}).bindPopup('Tlatelolco')
    var linea3_6  =  L.marker([19.444735, -99.145192],{icon:icon3},{draggable: true}).bindPopup('Guerrero')
    var linea3_7  =  L.marker([19.437403, -99.146675],{icon:icon3},{draggable: true}).bindPopup('Hidalgo')
    var linea3_8  =  L.marker([19.433361, -99.147699],{icon:icon3},{draggable: true}).bindPopup('Juárez')
    var linea3_9  =  L.marker([19.428034, -99.148748],{icon:icon3},{draggable: true}).bindPopup('Balderas')
    var linea3_10 =  L.marker([19.419490, -99.150400],{icon:icon3},{draggable: true}).bindPopup('Niños héroes')
    var linea3_11 =  L.marker([19.413672, -99.153414],{icon:icon3},{draggable: true}).bindPopup('Hospital general')
    var linea3_12 =  L.marker([19.407697, -99.155273],{icon:icon3},{draggable: true}).bindPopup('Centro médico')
    var linea3_13 =  L.marker([19.396057, -99.156021],{icon:icon3},{draggable: true}).bindPopup('Etiopia')
    var linea3_14 =  L.marker([19.386331, -99.157206],{icon:icon3},{draggable: true}).bindPopup('Eugenia')
    var linea3_15 =  L.marker([19.379220, -99.159429],{icon:icon3},{draggable: true}).bindPopup('División del norte')
    var linea3_16 =  L.marker([19.370831, -99.165055],{icon:icon3},{draggable: true}).bindPopup('Zapata')
    var linea3_17 =  L.marker([19.361621, -99.170821],{icon:icon3},{draggable: true}).bindPopup('Coyoacán')
    var linea3_18 =  L.marker([19.354122, -99.175406],{icon:icon3},{draggable: true}).bindPopup('Viveros')
    var linea3_19 =  L.marker([19.346120, -99.180810],{icon:icon3},{draggable: true}).bindPopup('Miguel A. Quevedo')
    var linea3_20 =  L.marker([19.336065, -99.176980],{icon:icon3},{draggable: true}).bindPopup('Copilco')
    var linea3_21 =  L.marker([19.324233, -99.174799],{icon:icon3},{draggable: true}).bindPopup('Universidad')
    
    /* Línea 4 */
    var linea4_1  =  L.marker([19.485079, -99.104384],{icon:icon4},{draggable: true}).bindPopup('Martín carrera')
    var linea4_2  =  L.marker([19.473961, -99.108148],{icon:icon4},{draggable: true}).bindPopup('Talismán')
    var linea4_3  =  L.marker([19.464827, -99.112013],{icon:icon4},{draggable: true}).bindPopup('Bondojito')
    var linea4_4  =  L.marker([19.456375, -99.113685],{icon:icon4},{draggable: true}).bindPopup('Consulado')
    var linea4_5  =  L.marker([19.449043, -99.116162],{icon:icon4},{draggable: true}).bindPopup('Canal del norte')
    var linea4_6  =  L.marker([19.439849, -99.118139],{icon:icon4},{draggable: true}).bindPopup('Morelos')
    var linea4_7  =  L.marker([19.429568, -99.119891],{icon:icon4},{draggable: true}).bindPopup('Candelaria')
    var linea4_8  =  L.marker([19.421824, -99.120498],{icon:icon4},{draggable: true}).bindPopup('Fray servando')
    var linea4_9  =  L.marker([19.409141, -99.122354],{icon:icon4},{draggable: true}).bindPopup('Jamaica')
    var linea4_10 =  L.marker([19.403050, -99.121691],{icon:icon4},{draggable: true}).bindPopup('Santa anita')
    
    /* Línea 5 */
    var linea5_1  =  L.marker([19.500778, -99.149136],{icon:icon5},{draggable: true}).bindPopup('Politécnico')
    var linea5_2  =  L.marker([19.493234, -99.145193],{icon:icon5},{draggable: true}).bindPopup('Instituto del petróleo')
    var linea5_3  =  L.marker([19.479137, -99.140638],{icon:icon5},{draggable: true}).bindPopup('Autobuses del norte')
    var linea5_4  =  L.marker([19.469722, -99.136521],{icon:icon5},{draggable: true}).bindPopup('La raza')
    var linea5_5  =  L.marker([19.463379, -99.130421],{icon:icon5},{draggable: true}).bindPopup('Misterios')
    var linea5_6  =  L.marker([19.458994, -99.119479],{icon:icon5},{draggable: true}).bindPopup('Valle gómez')
    var linea5_7  =  L.marker([19.455203, -99.112929],{icon:icon5},{draggable: true}).bindPopup('Consulado')
    var linea5_8  =  L.marker([19.451519, -99.105406],{icon:icon5},{draggable: true}).bindPopup('Eduardo molina')
    var linea5_9  =  L.marker([19.451261, -99.096207],{icon:icon5},{draggable: true}).bindPopup('Aragón')
    var linea5_10 =  L.marker([19.444613, -99.086651],{icon:icon5},{draggable: true}).bindPopup('Oceanía')
    var linea5_11 =  L.marker([19.434056, -99.087731],{icon:icon5},{draggable: true}).bindPopup('Terminal aérea')
    var linea5_12 =  L.marker([19.424453, -99.088276],{icon:icon5},{draggable: true}).bindPopup('Hangares')
    var linea5_13 =  L.marker([19.415197, -99.074246],{icon:icon5},{draggable: true}).bindPopup('Pantitlán')
    
    /* Línea 6 */
    var linea6_1  =  L.marker([19.504744, -99.199934],{icon:icon6},{draggable: true}).bindPopup('El rosario')
    var linea6_2  =  L.marker([19.494984, -99.196240],{icon:icon6},{draggable: true}).bindPopup('Tezozomoc')
    var linea6_3  =  L.marker([19.491017, -99.186269],{icon:icon6},{draggable: true}).bindPopup('Azcapotzalco')
    var linea6_4  =  L.marker([19.490711, -99.174125],{icon:icon6},{draggable: true}).bindPopup('Ferrería')
    var linea6_5  =  L.marker([19.488815, -99.163149],{icon:icon6},{draggable: true}).bindPopup('Norte 45')
    var linea6_6  =  L.marker([19.489860, -99.156026],{icon:icon6},{draggable: true}).bindPopup('Vallejo')
    var linea6_7  =  L.marker([19.493198, -99.145181],{icon:icon6},{draggable: true}).bindPopup('Instituto del petróleo')
    var linea6_8  =  L.marker([19.488001, -99.134720],{icon:icon6},{draggable: true}).bindPopup('Lindavista')
    var linea6_9  =  L.marker([19.483853, -99.125605],{icon:icon6},{draggable: true}).bindPopup('Deportivo 18 de marzo')
    var linea6_10 =  L.marker([19.481631, -99.118308],{icon:icon6},{draggable: true}).bindPopup('La villa')
    var linea6_11 =  L.marker([19.483014, -99.107195],{icon:icon6},{draggable: true}).bindPopup('Martín carrera')
    
    /* Línea 7 */
    var linea7_1  =  L.marker([19.504737, -99.199938],{icon:icon7},{draggable: true}).bindPopup('El rosario')
    var linea7_2  =  L.marker([19.490665, -99.195288],{icon:icon7},{draggable: true}).bindPopup('Aquiles serdán')
    var linea7_3  =  L.marker([19.479144, -99.189750],{icon:icon7},{draggable: true}).bindPopup('Camarones')
    var linea7_4  =  L.marker([19.469355, -99.189367],{icon:icon7},{draggable: true}).bindPopup('Refinería')
    var linea7_5  =  L.marker([19.458431, -99.188504],{icon:icon7},{draggable: true}).bindPopup('Tacuba')
    var linea7_6  =  L.marker([19.444944, -99.191789],{icon:icon7},{draggable: true}).bindPopup('San joaquín')
    var linea7_7  =  L.marker([19.433605, -99.190950],{icon:icon7},{draggable: true}).bindPopup('Polanco')
    var linea7_8  =  L.marker([19.425023, -99.191911],{icon:icon7},{draggable: true}).bindPopup('Auditorio')
    var linea7_9  =  L.marker([19.411747, -99.191385],{icon:icon7},{draggable: true}).bindPopup('Constituyentes')
    var linea7_10 =  L.marker([19.402233, -99.187503],{icon:icon7},{draggable: true}).bindPopup('Tacubaya')
    var linea7_11 =  L.marker([19.391450, -99.185852],{icon:icon7},{draggable: true}).bindPopup('San pedro de los pinos')
    var linea7_12 =  L.marker([19.385015, -99.186863],{icon:icon7},{draggable: true}).bindPopup('San antonio')
    var linea7_13 =  L.marker([19.375996, -99.187311],{icon:icon7},{draggable: true}).bindPopup('Mixcoac')
    var linea7_14 =  L.marker([19.361563, -99.189424],{icon:icon7},{draggable: true}).bindPopup('Barranca del muerto')
    
    /* Línea 8 */
    var linea8_1  =  L.marker([19.443975, -99.139053],{icon:icon8},{draggable: true}).bindPopup('Garibaldi')
    var linea8_2  =  L.marker([19.436990, -99.140513],{icon:icon8},{draggable: true}).bindPopup('Bellas artes')
    var linea8_3  =  L.marker([19.431549, -99.141680],{icon:icon8},{draggable: true}).bindPopup('San juan de letrán')
    var linea8_4  =  L.marker([19.427379, -99.142482],{icon:icon8},{draggable: true}).bindPopup('Salto del Agua')
    var linea8_5  =  L.marker([19.421555, -99.143201],{icon:icon8},{draggable: true}).bindPopup('Doctores')
    var linea8_6  =  L.marker([19.413270, -99.144048],{icon:icon8},{draggable: true}).bindPopup('Obrera')
    var linea8_7  =  L.marker([19.408733, -99.135584],{icon:icon8},{draggable: true}).bindPopup('Chabacano')
    var linea8_8  =  L.marker([19.413457, -99.128250],{icon:icon8},{draggable: true}).bindPopup('La viga')
    var linea8_9  =  L.marker([19.404160, -99.120643],{icon:icon8},{draggable: true}).bindPopup('Santa anita')
    var linea8_10 =  L.marker([19.398140, -99.113480],{icon:icon8},{draggable: true}).bindPopup('Coyuya')
    var linea8_11 =  L.marker([19.388710, -99.112198],{icon:icon8},{draggable: true}).bindPopup('Iztacalco')
    var linea8_12 =  L.marker([19.379501, -99.109643],{icon:icon8},{draggable: true}).bindPopup('Apatlaco')
    var linea8_13 =  L.marker([19.373805, -99.107808],{icon:icon8},{draggable: true}).bindPopup('Aculco')
    var linea8_14 =  L.marker([19.364569, -99.109193],{icon:icon8},{draggable: true}).bindPopup('Escuadrón 201')
    var linea8_15 =  L.marker([19.356092, -99.101292],{icon:icon8},{draggable: true}).bindPopup('Atlalilco')
    var linea8_16 =  L.marker([19.357727, -99.093280],{icon:icon8},{draggable: true}).bindPopup('Iztapalapa')
    var linea8_17 =  L.marker([19.355942, -99.085598],{icon:icon8},{draggable: true}).bindPopup('Cerro de la estrella')
    var linea8_18 =  L.marker([19.351034, -99.074890],{icon:icon8},{draggable: true}).bindPopup('UAMI')
    var linea8_19 =  L.marker([19.346034, -99.063933],{icon:icon8},{draggable: true}).bindPopup('Constitución 1917')
    
    /* Línea 9 */
    var linea9_1  =  L.marker([19.401932, -99.187351],{icon:icon9},{draggable: true}).bindPopup('Tacubaya')
    var linea9_2  =  L.marker([19.406069, -99.178900],{icon:icon9},{draggable: true}).bindPopup('Patriotismo')
    var linea9_3  =  L.marker([19.405814, -99.168962],{icon:icon9},{draggable: true}).bindPopup('Chilpancingo')
    var linea9_4  =  L.marker([19.406595, -99.155222],{icon:icon9},{draggable: true}).bindPopup('Centro médico')
    var linea9_5  =  L.marker([19.407201, -99.144197],{icon:icon9},{draggable: true}).bindPopup('Lázaro cárdenas')
    var linea9_6  =  L.marker([19.408716, -99.135583],{icon:icon9},{draggable: true}).bindPopup('Chabacano')
    var linea9_7  =  L.marker([19.409109, -99.122346],{icon:icon9},{draggable: true}).bindPopup('Jamaica')
    var linea9_8  =  L.marker([19.408438, -99.113259],{icon:icon9},{draggable: true}).bindPopup('Mixiuhca')
    var linea9_9  =  L.marker([19.408544, -99.103139],{icon:icon9},{draggable: true}).bindPopup('Velódromo')
    var linea9_10 =  L.marker([19.408417, -99.091281],{icon:icon9},{draggable: true}).bindPopup('Ciudad deportiva')
    var linea9_11 =  L.marker([19.407212, -99.082616],{icon:icon9},{draggable: true}).bindPopup('Puebla')
    var linea9_12 =  L.marker([19.415355, -99.072223],{icon:icon9},{draggable: true}).bindPopup('Pantitlán')
    
    /* Línea 12 */
    var linea12_1  =  L.marker([19.286001, -99.014204],{icon:icon12},{draggable: true}).bindPopup('Tláhuac')
    var linea12_2  =  L.marker([19.294346, -99.024012],{icon:icon12},{draggable: true}).bindPopup('Tlaltenco')
    var linea12_3  =  L.marker([19.296644, -99.034296],{icon:icon12},{draggable: true}).bindPopup('Zapotitlán')
    var linea12_4  =  L.marker([19.300009, -99.045974],{icon:icon12},{draggable: true}).bindPopup('Nopalera')
    var linea12_5  =  L.marker([19.304284, -99.059481],{icon:icon12},{draggable: true}).bindPopup('Olivos')
    var linea12_6  =  L.marker([19.306281, -99.065233],{icon:icon12},{draggable: true}).bindPopup('Tezonco')
    var linea12_7  =  L.marker([19.317733, -99.074367],{icon:icon12},{draggable: true}).bindPopup('Periférico oriente')
    var linea12_8  =  L.marker([19.320507, -99.085877],{icon:icon12},{draggable: true}).bindPopup('Calle 11')
    var linea12_9  =  L.marker([19.322199, -99.095828],{icon:icon12},{draggable: true}).bindPopup('Lomas estrella')
    var linea12_10 =  L.marker([19.328150, -99.104483],{icon:icon12},{draggable: true}).bindPopup('San andrés tomatlán')
    var linea12_11 =  L.marker([19.336894, -99.108942],{icon:icon12},{draggable: true}).bindPopup('Culhuacán')
    var linea12_12 =  L.marker([19.356092, -99.101292],{icon:icon12},{draggable: true}).bindPopup('Atlalilco')
    var linea12_13 =  L.marker([19.357781, -99.123017],{icon:icon12},{draggable: true}).bindPopup('Mexicaltzingo')
    var linea12_14 =  L.marker([19.359903, -99.143018],{icon:icon12},{draggable: true}).bindPopup('Ermita')
    var linea12_15 =  L.marker([19.361345, -99.151438],{icon:icon12},{draggable: true}).bindPopup('Eje central')
    var linea12_16 =  L.marker([19.370611, -99.158454],{icon:icon12},{draggable: true}).bindPopup('Parque de los venados')
    var linea12_17 =  L.marker([19.370723, -99.165172],{icon:icon12},{draggable: true}).bindPopup('Zapata')
    var linea12_18 =  L.marker([19.372014, -99.170907],{icon:icon12},{draggable: true}).bindPopup('Hospital 20 de nov')
    var linea12_19 =  L.marker([19.373507, -99.178054],{icon:icon12},{draggable: true}).bindPopup('Insurgentes sur')
    var linea12_20 =  L.marker([19.375894, -99.187344],{icon:icon12},{draggable: true}).bindPopup('Mixcoac')
    
    /* Línea A */
    var lineaA_1  =  L.marker([19.415300, -99.071916],{icon:icona},{draggable: true}).bindPopup('Pantitlán')
    var lineaA_2  =  L.marker([19.404642, -99.069606],{icon:icona},{draggable: true}).bindPopup('Agricola oriental')
    var lineaA_3  =  L.marker([19.398797, -99.059467],{icon:icona},{draggable: true}).bindPopup('Canal de san juan')
    var lineaA_4  =  L.marker([19.391290, -99.046334],{icon:icona},{draggable: true}).bindPopup('Tepalcates')
    var lineaA_5  =  L.marker([19.385201, -99.035721],{icon:icona},{draggable: true}).bindPopup('Guelatao')
    var lineaA_6  =  L.marker([19.373288, -99.017042],{icon:icona},{draggable: true}).bindPopup('Peñón viejo')
    var lineaA_7  =  L.marker([19.364695, -99.005641],{icon:icona},{draggable: true}).bindPopup('Acatitla')
    var lineaA_8  =  L.marker([19.360289, -98.995157],{icon:icona},{draggable: true}).bindPopup('Santa marta')
    var lineaA_9  =  L.marker([19.359034, -98.976832],{icon:icona},{draggable: true}).bindPopup('Los reyes')
    var lineaA_10 =  L.marker([19.350590, -98.960941],{icon:icona},{draggable: true}).bindPopup('La paz')

    /* Linea B */
    var lineaB_1  =  L.marker([19.446195, -99.152456],{icon:iconb},{draggable: true}).bindPopup('Buenavista')
    var lineaB_2  =  L.marker([19.445252, -99.146708],{icon:iconb},{draggable: true}).bindPopup('Guerrero')
    var lineaB_3  =  L.marker([19.443655, -99.138924],{icon:iconb},{draggable: true}).bindPopup('Garibaldi')
    var lineaB_4  =  L.marker([19.443336, -99.131828],{icon:iconb},{draggable: true}).bindPopup('Lagunilla')
    var lineaB_5  =  L.marker([19.442817, -99.124095],{icon:iconb},{draggable: true}).bindPopup('Tepito')
    var lineaB_6  =  L.marker([19.439574, -99.119138],{icon:iconb},{draggable: true}).bindPopup('Morelos')
    var lineaB_7  =  L.marker([19.431151, -99.114166],{icon:iconb},{draggable: true}).bindPopup('San Lázaro')
    var lineaB_8  =  L.marker([19.436575, -99.103702],{icon:iconb},{draggable: true}).bindPopup('Ricardo flores magón')
    var lineaB_9  =  L.marker([19.440829, -99.094196],{icon:iconb},{draggable: true}).bindPopup('Romero rubio')
    var lineaB_10 =  L.marker([19.445756, -99.087175],{icon:iconb},{draggable: true}).bindPopup('Oceanía')
    var lineaB_11 =  L.marker([19.451025, -99.079305],{icon:iconb},{draggable: true}).bindPopup('Deportivo oceanía')
    var lineaB_12 =  L.marker([19.458126, -99.069280],{icon:iconb},{draggable: true}).bindPopup('Bosque de aragón')
    var lineaB_13 =  L.marker([19.461672, -99.061314],{icon:iconb},{draggable: true}).bindPopup('Villa de aragón')
    var lineaB_14 =  L.marker([19.472650, -99.054720],{icon:iconb},{draggable: true}).bindPopup('Nezahualcoyotl')
    var lineaB_15 =  L.marker([19.485583, -99.049033],{icon:iconb},{draggable: true}).bindPopup('Impulsora')
    var lineaB_16 =  L.marker([19.491080, -99.046612],{icon:iconb},{draggable: true}).bindPopup('Río de los remedios')
    var lineaB_17 =  L.marker([19.501322, -99.042152],{icon:iconb},{draggable: true}).bindPopup('Muzquiz')
    var lineaB_18 =  L.marker([19.514849, -99.036211],{icon:iconb},{draggable: true}).bindPopup('Ecatepec')
    var lineaB_19 =  L.marker([19.521330, -99.033326],{icon:iconb},{draggable: true}).bindPopup('Olímpica')
    var lineaB_20 =  L.marker([19.528584, -99.030133],{icon:iconb},{draggable: true}).bindPopup('Plaza aragón')
    var lineaB_21 =  L.marker([19.534525, -99.027495],{icon:iconb},{draggable: true}).bindPopup('Ciudad azteca')
    
    var linea_1 = L.layerGroup([linea1_1, linea1_2, linea1_3, linea1_4, linea1_5, linea1_6, linea1_7, linea1_8, linea1_9, linea1_10,linea1_11,linea1_12,linea1_13,linea1_14,linea1_15,linea1_16,linea1_17,linea1_18,linea1_19,linea1_20])
    var linea_2 = L.layerGroup([linea2_1, linea2_2, linea2_3, linea2_4, linea2_5, linea2_6, linea2_7, linea2_8, linea2_9, linea2_10,linea2_11,linea2_12,linea2_13,linea2_14,linea2_15,linea2_16,linea2_17,linea2_18,linea2_19,linea2_20,linea2_21,linea2_22,linea2_23,linea2_24])
    var linea_3 = L.layerGroup([linea3_1, linea3_2, linea3_3, linea3_4, linea3_5, linea3_6, linea3_7, linea3_8, linea3_9, linea3_10,linea3_11,linea3_12,linea3_13,linea3_14,linea3_15,linea3_16,linea3_17,linea3_18,linea3_19,linea3_20,linea3_21])
    var linea_4 = L.layerGroup([linea4_1, linea4_2, linea4_3, linea4_4, linea4_5, linea4_6, linea4_7, linea4_8, linea4_9, linea4_10])
    var linea_5 = L.layerGroup([linea5_1, linea5_2, linea5_3, linea5_4, linea5_5, linea5_6, linea5_7, linea5_8, linea5_9, linea5_10,linea5_11,linea5_12,linea5_13])
    var linea_6 = L.layerGroup([linea6_1, linea6_2, linea6_3, linea6_4, linea6_5, linea6_6, linea6_7, linea6_8, linea6_9, linea6_10,linea6_11])
    var linea_7 = L.layerGroup([linea7_1, linea7_2, linea7_3, linea7_4, linea7_5, linea7_6, linea7_7, linea7_8, linea7_9, linea7_10,linea7_11,linea7_12,linea7_13,linea7_14])
    var linea_8 = L.layerGroup([linea8_1, linea8_2, linea8_3, linea8_4, linea8_5, linea8_6, linea8_7, linea8_8, linea8_9, linea8_10,linea8_11,linea8_12,linea8_13,linea8_14,linea8_15,linea8_16,linea8_17,linea8_18,linea8_19])
    var linea_9 = L.layerGroup([linea9_1, linea9_2, linea9_3, linea9_4, linea9_5, linea9_6, linea9_7, linea9_8, linea9_9, linea9_10,linea9_11,linea9_12])
   var linea_12 = L.layerGroup([linea12_1, linea12_2, linea12_3, linea12_4, linea12_5, linea12_6, linea12_7, linea12_8, linea12_9, linea12_10,linea12_11,linea12_12,linea12_13,linea12_14,linea12_15,linea12_16,linea12_17,linea12_18,linea12_19,linea12_20])
    var linea_A = L.layerGroup([lineaA_1, lineaA_2, lineaA_3, lineaA_4, lineaA_5, lineaA_6, lineaA_7, lineaA_8, lineaA_9, lineaA_10])
    var linea_B = L.layerGroup([lineaB_1, lineaB_2, lineaB_3, lineaB_4, lineaB_5, lineaB_6, lineaB_7, lineaB_8, lineaB_9, lineaB_10,lineaB_11,lineaB_12,lineaB_13,lineaB_14,lineaB_15,lineaB_16,lineaB_17,lineaB_18,lineaB_19,lineaB_20,lineaB_21])
    
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    })

    var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'});
    
    var map = L.map('map',{
        center: [19.4007336,-99.1236127],
        zoom: 11,
        layers: [osm, linea_1]
    })
    
    var baseMaps = {
        "OpenStreetMap": osm,
        "OpenStreetMap.HOT": osmHOT
    }
    
    var overlayMaps = {
        "Línea 1": linea_1,
        "Línea 2": linea_2,
        "Línea 3": linea_3,
        "Línea 4": linea_4,
        "Línea 5": linea_5,
        "Línea 6": linea_6,
        "Línea 7": linea_7,
        "Línea 8": linea_8,
        "Línea 9": linea_9,
        "Línea 12": linea_12,
        "Línea A": linea_A,
        "Línea B": linea_B,
        
    }

    var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map)

        
    var openTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: 'Map data: © OpenStreetMap contributors, SRTM | Map style: © OpenTopoMap (CC-BY-SA)'
    });

    layerControl.addBaseLayer(openTopoMap, "OpenTopoMap");
}