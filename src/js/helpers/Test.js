export default class Test {
  constructor(test, score = false) {
    this.results = test;

    if (this.results.ordername) {
      this.results.strength = this.parseStrengthFromName(
        this.results.ordername
      );
    }

    if (score) {
      this.results.score = score;
    }

    this.checkForBadTotalCBD();
  }

  parseStrengthFromName(ordername) {
    try {
      const reg = /\d+/;
      const containsNumber = ordername.match(reg);
      if (containsNumber) {
        return containsNumber[0] + ' MG';
      } else {
        return false;
      }
    } catch (error) {
      console.warn(ordername);
      console.error(Error(error));
    }
  }

  checkForBadTotalCBD() {
    if (this.results.totalcbd === 'N/D') {
      try {
        /*
          un-comment the following line for further debugging of N/D totalcbd results.
          if a lab result shows N/D, direct the user to the COA for the true cbd content.
        */
        // console.warn(this.results);
        this.results.viewCBDinCOA = true;

        this.results.viewcoa = 'View total CBD in PDF';
      } catch (error) {
        console.error(Error(error));
      }
    }
  }
}
