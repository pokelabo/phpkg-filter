Feature: TrimFilter

  Scenario Outline: EmailFilter
    When "email"フィルタに"<option_map>"を設定して値"<value>"をフィルタする
    Then フィルタの結果は"<result>"である

    Examples:
    | value                    | option_map        | result                 | comment                   |
    | 'test@example.com'       |                   | test@example.com       | not to be modified        |
    | 'test+alias@example.com' |                   | test+alias@example.com | not to be modified        |
    | 'test+alias@example.com' | {normalize: true} | test@example.com       | alias to be stripped      |
    | '+alias@example.com'     | {normalize: true} | @example.com           | results invalid format... |
