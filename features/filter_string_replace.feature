Feature: StringReplaceFilter

  Scenario Outline: StringReplaceFilter
    When 値"<value>"を検索文字"<string>"で"<replace>"に置き換えるよう"string_replace"でフィルタする
    Then フィルタの結果は"<result>"である

    Examples:
    | value    | string    | replace | result   | comment          |
    | aabcAabc | abc       | xyz     | axyzAxyz |                  |
    | aabcAabc | abc       |         | aA       | to empty string  |
    | aba      | a         | xyz     | xyzbxyz  | to longer string |
    | あいう   | あ        | お      | おいう   | UNICODE string   |
    | aabcAabc | /^[abc]+/ | xyz     | aabcAabc | regexp           |
    | ''       | abc       | x       |          | empty string     |
    | null     | abcc      | x       | null     | null             |
