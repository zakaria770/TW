/* 
 *   fd : FormData instance
 *   returns : query string (without initial '?')
 */
function formDataToQueryString (fd){
  return Array.from(fd).map(function(p){return encodeURIComponent(p[0])+'='+encodeURIComponent(p[1]);}).join('&');
}
/*
 *   Fetch JSON resource
 *   Return : Promise of object
 */
function fetchFromJson(url, ...options){
    return fetch(url,...options)
      .then(function(response){
              if (!response.ok)
                    throw new Error(response.statusText);
              return response.json();
            });
}
/*
 *   Fetch text resource
 *   Return : Promise of string
 */
function fetchText(url, ...options){
    return fetch(url,...options)
      .then(function(response){
              if (!response.ok)
                    throw new Error(response.statusText);
              return response.text();
            });
}
