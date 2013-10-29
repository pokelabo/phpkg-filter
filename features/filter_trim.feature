Feature: TrimFilter

  Scenario Outline: TrimFilter
    When 値"<value>"を"trim"に"<option_map>"を設定してフィルタする
    Then フィルタの結果は"<result>"である

    Examples:
    | value               | option_map                                    | result         | comment                |
    | '  a b c  '         |                                               | a b c          | spaces                 |
    | '　a　b　'          |                                               | a　b           | multibytes spaces      |
    | ' a   bc  '         |                                               | a   bc         | tabs                   |
    | '\na\nb\nc\n'       |                                               | a\nb\nc        | carridge returns       |
    | '\n 　    a\n 　  ' |                                               | a              | mixed                  |
    | 'a b c'             |                                               | a b c          | no spaces              |
    | ' a b c '           | left: false                                   | ' a b c'       | trim right             |
    | ' a b c '           | right: false                                  | 'a b c '       | trim left              |
    | ' a b c '           | { left: false, right: false }                 | ' a b c '      | no trim                |
    | '\n 　a\n　  '      | unicode: false                                | '　a\n　'      | ascii only             |
    | '\n 　a\n　  '      | { unicode: false, left: false }               | '\n 　a\n　'   | ascii only, trim right |
    | '\n 　a\n　  '      | { unicode: false, right: false }              | '　a\n　  '     | ascii only, trim left  |
    | '\n 　a\n　  '      | { unicode: false, left: false, right: false } | '\n 　a\n　  ' | ascii only, no trim    |
    | ''                  |                                               |                | empty string           |
    | null                |                                               | null           | null                   |
