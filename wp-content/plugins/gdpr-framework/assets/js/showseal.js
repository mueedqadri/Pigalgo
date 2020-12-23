var gdpr_function_name = 'openpopup_' + gdpr_seal_var.gdpr_imagecode;

this[gdpr_function_name] = function (params) {
	var left = (screen.width/2)-(550/2);
    var top  = (screen.height/2)-(450/2);
	window.open("https://orders.data443.com/seal/status.php?params="+gdpr_seal_var.gdpr_imageparams, "Verify", "toolbar=0,location=0, directories=0, status=0, menubar=0, width=550, height=450, top="+top+", left="+left);
	return false;
  }