const url="google.com"

const data = {
	photo_id: '3',
	name: 'petr',
}


fetch(url,
		headers: {
			'Accept': 'application/json',
		},
		method: 'post',
		body: JSON.stringify(data);
	 )

