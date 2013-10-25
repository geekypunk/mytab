var JsonFormatter = {
	stringify: function (cipherParams) {
		// create json object with ciphertext
		var jsonObj = {
			ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)
		};

		// optionally add iv and salt
		if (cipherParams.iv) {
			jsonObj.iv = cipherParams.iv.toString();
		}
		if (cipherParams.salt) {
			jsonObj.s = cipherParams.salt.toString();
		}

		// stringify json object
		return JSON.stringify(jsonObj);
	},

	parse: function (jsonStr) {
		// parse json string
		var jsonObj = JSON.parse(jsonStr);

		// extract ciphertext from json object, and create cipher params object
		var cipherParams = CryptoJS.lib.CipherParams.create({
			ciphertext: CryptoJS.enc.Base64.parse(jsonObj.ct)
		});

		// optionally extract iv and salt
		if (jsonObj.iv) {
			cipherParams.iv = CryptoJS.enc.Hex.parse(jsonObj.iv)
		}
		if (jsonObj.s) {
			cipherParams.salt = CryptoJS.enc.Hex.parse(jsonObj.s)
		}

		return cipherParams;
	}
};

var encryptedCornellssoPass = {"ct":"o//Sg7OzYDX7wGYKVWlnbg==","iv":"8f3450fdc844201f0ab70a0423bb0432","s":"5abb1c5de6a30749"};

var encryptedCCnetPass = {"ct":"ECcucsbx/HXqrzvRt5ecIg==","iv":"8420dc7db599f0c0738e61c7d1fbbd74","s":"6a09231a8fabc56b"};

var encryptedPiazzaPass = {"ct":"ECcucsbx/HXqrzvRt5ecIg==","iv":"8420dc7db599f0c0738e61c7d1fbbd74","s":"6a09231a8fabc56b"};