var messages = document.getElementById("messages");
var textbox = document.getElementById("textbox");
var button = document.getElementById("button");
var chatWindow = document.getElementById("chatWindow");



button.addEventListener("click", function(){


	if (textbox.value != "") {
		var newArticle = document.createElement("div");
		newArticle.innerHTML = "<article class=\"msg-container msg-self\" id=\"msg-0\"> <div class=\"msg-box\"><div class=\"flr\"><div class=\"messages\"><p class=\"msg\" id=\"msg-2\">" + textbox.value + "</p></div></div><img class=\"user-img\" id=\"user-0\" src=\"//gravatar.com/avatar/56234674574535734573000000000001?d=retro\" /></div></article>"

		var bot = "I'm not sure I understand what it is you're looking for.";

		if (textbox.value.includes("whiskey")) {
			bot = "Try Kelsey Creek 90 Proof Bourbon. $34.99 for 1.75L <br><br><img src=\"./images/kk.png\">";
		}

		if (textbox.value.includes("rum")) {
			bot = "Try Boquoron.";
		}

		var response = document.createElement("div");
		response.innerHTML = "<article class=\"msg-container msg-remote\" id=\"msg-0\"><div class=\"msg-box\"><img class=\"user-img\" id=\"user-0\" src=\"./images/gglogo.png\" /><div class=\"flr\"><div class=\"messages\"><p class=\"msg\" id=\"msg-0\">" + bot + "</p></div></div></div></article>"

		messages.appendChild(newArticle);
		textbox.value = "";
		chatWindow.scrollTo(0,chatWindow.scrollHeight);

			
		setTimeout(function () {
			messages.appendChild(response);
			chatWindow.scrollTo(0,chatWindow.scrollHeight);
		}, 3000);
	
	}

});