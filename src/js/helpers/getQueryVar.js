export default function getQueryVar(find) {
  const query = window.location.search.substring(1);
  const allVars = query.split('&');

  for (let i = 0, n = allVars.length; i < n; i++) {
    const pair = allVars[i].split('=');

    if (decodeURIComponent(pair[0]) == find) {
      return decodeURIComponent(pair[1]);
    }
  }
}
