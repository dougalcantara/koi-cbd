export default class Test {
  constructor(test, score = false) {
    this.results = test;

    if (this.results && this.results.ordername) {
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
    if (this.results && this.results.totalcbd === 'N/D') {
      try {
        this.results.viewCBDinCOA = true;

        this.results.viewcoa = 'View total CBD in PDF';
      } catch (error) {
        console.error(Error(error));
      }
    }
  }
}
