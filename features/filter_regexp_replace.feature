Feature: RegexpReplaceFilter

  Scenario Outline: RegexpReplaceFilter
    When 値"<value>"を正規表現"<search>"で"<replace>"に置き換えるよう"regexp_replace"でフィルタする
    Then フィルタの結果は"<result>"である

    Examples:
    | value    | search     | replace | result | comment      |
    | aabcAabc | /^[abc]+/  | x       | xAabc  |              |
    | aabcAabc | /^[abc]+/i | x       | x      | with flag    |
    | ''       | /^[abc]+/  | x       |        | empty string |
    | null     | /^[abc]+/  | x       | null   | null         |
