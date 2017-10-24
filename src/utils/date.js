export const getPrettyDate = {
  methods: {
    getPrettyDate(timestamp = null, type = null, wpACFFormat = null) {
      if (!timestamp) return '';

      const days = ['Søndag', 'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag'];
      const months = ['januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december'];
      const shortMonths = ['jan', 'feb', 'mar', 'apr', 'maj', 'juni', 'juli', 'aug', 'sep', 'okt', 'nov', 'dec'];
      const monthNumbers = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

      let d;
      if ( wpACFFormat ) { // Expected wpACFFormat = YYYYMMDD
        const yyyy = timestamp.substring(0,4);
        const mm   = timestamp.substring(4,6);
        const dd   = timestamp.substring(6,8);
        d = new Date(yyyy, mm - 1, dd);
      } else {
        d = new Date(timestamp);
      }

      const dayOfTheWeek = days[d.getDay()];
      const date = d.getDate();
      const dateTwoDigits = date.toString().length === 1 ? "0" + date : date;
      const month = months[d.getMonth()];
      const shortMonth = shortMonths[d.getMonth()];
      const monthNumber = monthNumbers[d.getMonth()];
      const year = d.getFullYear();
      const yearShort = year.toString().substr(-2);

      let prettyDate = null;
      const standard = `${dayOfTheWeek} ${date}. ${month}`;

      if ( type === 'shortest' ) {
        prettyDate = `${dateTwoDigits}.${monthNumber}.${yearShort}`;
      } else if ( type === 'shorter' ) {
        prettyDate = `${date} ${shortMonth} ${yearShort}`;
      } else if ( type === 'short' ) {
        prettyDate = `${date} ${month} ${year}`;
      } else if (type === 'onlyDateMonth') {
        prettyDate = `${date} ${month}`;
      } else {
        prettyDate = standard;
      }

      return prettyDate;
    }
  }
}
