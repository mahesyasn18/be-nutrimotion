export function initFormValidationExample() {
  return {
    username: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required"],
    },
    number: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required", "number"],
    },
    email: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required", "email"],
    },
    minmax: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required", "min:5", "max:15"],
    },
    minmaxLength: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required", "minLength:8", "maxLength:20"],
    },
    url: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required", "url"],
    },
    instagramUsername: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: [
        "required",
        "regexMatch:^(?!.*\\.\\.)(?!.*\\.$)[^\\W][\\w.]{0,29}$",
      ],
    },
    startWith: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required", "startingWith:A"],
    },
    endWith: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required", "endingWith:Z"],
    },
    gender: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required"],
    },
    dob: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required"],
    },
    weight: {
      value: "",
      errorMessage: "",
      blurred: false,
      validate: ["required", "number"],
    },
    getErrorMessage(value, rules) {
      return Iodine.assert(value, rules).error;
    }
  };
}
