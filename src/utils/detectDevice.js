export const isDevice = {
  methods: {
    isDevice() {
      const userAgent = navigator.userAgent || navigator.vendor || window.opera;
      let device = false;
      if ( userAgent.match( /iPad/i ) || userAgent.match( /iPhone/i ) || userAgent.match( /iPod/i ) ) {
        device = true;
      } else if ( userAgent.match( /Android/i ) ) {
        device = true;
      }
      return device;
    }
  }
}

export const whichDevice = {
  methods: {
    whichDevice() {
      let device = '';
      if (navigator.userAgent.match(/iPad/i)) device = 'iPad';
      if (navigator.userAgent.match(/iPhone/i)) device = 'iPhone';
      if (navigator.userAgent.match(/Android/i)) {
        device = navigator.userAgent.match(/Mobile/i) ? 'android mobile' : 'android tablet';
      }
      return device;
    }
  }
}
