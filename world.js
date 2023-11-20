let lookupButton = null;
let query = "";

function citySwitch() {
  query = "&lookup=cities";
  engageLookup();
}

document.addEventListener("DOMContentLoaded", prepare);

function prepare() {
  lookupButton = document.querySelector("#lookup");
  lookupButton.addEventListener("click", engageLookup);
  citiesLookupButton = document.querySelector("#cityLookup");
  citiesLookupButton.addEventListener("click", citySwitch);
}

function engageLookup() {
  //console.log("Engaging");
  const country = document.querySelector("#country").value;

  // Make the AJAX request
  fetchData(country)
    .then((response) => response.text())
    .then((data) => {
      // Handle the data

      let parentElement = document.querySelector("#result");
      if (document.querySelector("table")) {
        let oldUl = document.querySelector("table");
        oldUl.remove();
      }

      //parentElement.appendChild(data);
      parentElement.innerHTML = data;
      //console.log("data handled");
      query = "";
      //console.log(data);
    })
    .catch((error) => {
      // Handle errors
      console.error("Error:", error);
      //console.log("Error:", error);
    });
}

function fetchData(country) {
  // Use the Fetch API to make an AJAX request
  return fetch("world.php".concat("?country=", country, query)).then(
    (response) => {
      //console.log("Fetching");
      if (!response.ok) {
        //console.log("net not ok :" + response);
        throw new Error("Network response was not ok");
      }
      /*console.log(
        "net is ok.. response is \n" + response + " " + typeof response
      );*/
      return response;
    }
  );
}
