const btnBuscar = document.getElementById('buscarDNI');

btnBuscar.addEventListener('click', async (e)=>{
  e.preventDefault();
  const dni = document.getElementById('dni').value;
  if(dni === ''){
    return swal({
      title: 'Atención',
      text: 'Rellene el DNI',
      icon: 'warning',
    });
  }
  if(isNaN(dni)){
    return swal({
      title: 'Atención',
      text: 'El DNI debe contener números',
      icon: 'error',
    });
  }
  if(dni.length !== 8){
    return swal({
      title: 'Atención',
      text: 'El DNI tiene 8 números, revise!',
      icon: 'error',
    });
  }
  try {
    const token = '$apis-token-9574.qU2LIl2GFE9yYKYBQYpHCboOJmRo2S-B'; // El token es mío luego lo ponemos el tuyo
    const apiUrl = `https://api.apis.net.pe/v2/reniec/dni?numero=${dni}`;
    const response = await fetch(apiUrl, {
      method: 'GET',
      mode: 'cors',
      cache: 'no-cache',
      headers: new Headers({ 'Authorization': `${token}`}),
    });
    if(!response.ok){
      throw new Error('Error en la respuesta de la API');
    }
    const data = await response.json();
    document.getElementById('nombre').value = data.nombres;
    document.getElementById('apellidos').value = `${data.apellidoPaterno} ${data.apellidoMaterno}`;
    swal({
      title: 'OK',
      text: 'todo ok',
      icon: 'success',
    });
  } catch (error) {
    return swal({
      title: 'Atención',
      text: 'Error al solicitar los datos ' + error,
      icon: 'error',
    });
  }
});

