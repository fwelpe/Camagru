// UTILS
function processStatus(response) {
	if (response.status === 200 || response.status === 0) {
	  return Promise.resolve(response)
	}
	else {
	  return Promise.reject(new Error(`Error loading: ${url}`))
	}
  }

  function parseBlob(response) {
	return response.blob()
  }

  function parseJson(response) {
	return response.json()
  }

  // download/upload
  function downloadFile(url) {
	return fetch(url)
	  .then(processStatus)
	  .then(parseBlob)
  }

  function uploadImageToImgur(blob) {
	var formData = new FormData()
	formData.append('type', 'file')
	formData.append('image', blob)

	return fetch('https://api.imgur.com/3/upload.json', {
	  method: 'POST',
	  headers: {
		Accept: 'application/json',
		Authorization: 'Client-ID dc708f3823b7756'// imgur specific
	  },
	  body: formData
	})
	  .then(processStatus)
	  .then(parseJson)
  }


  // --- ACTION ---

  var sourceImageUrl = 'https://upload.wikimedia.org/wikipedia/commons/9/98/Pet_dog_fetching_sticks_in_Wales-3April2010.jpg'


  $('#log-box').logbox()

  $('#start').on('click', function(ev) {
	$.log(`Started downloading image from <a href="${sourceImageUrl}">image url</a>`)

	downloadFile(sourceImageUrl)  // download file from one resource
	  .then(uploadImageToImgur)   // upload it to another
	  .then(function(data) {
		$.log(`Image successfully uploaded to <a href="https://imgur.com/
	${data.data.id}">imgur.com url</a>`);
		$.log(`<img src="${data.data.link}"/>`)
	  })
	  .catch(function(error) {
		$.error(error.message || error);
	  })

	ev.stopPropagation()
  })
